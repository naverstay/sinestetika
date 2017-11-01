<?php

use App\Models\Project;
use App\Models\ProjectSection;

use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Format\Video\X264;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\Ogg;

use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(
    ProjectSection::class,
    function (ModelConfiguration $model) {
        $model->setTitle('Разделы проектов');

        // Display
        $model->onDisplay(function () {
            $display = AdminDisplay::table();

            $display->with(['project']);

            $display->setColumns([
                AdminColumn::relatedLink('project.caption', 'Проект'),
                AdminColumn::text('note', 'Примечание'),
                AdminColumn::custom('Тип', function($model) {
                    if($model->type == 'image') {
                        return 'Фото';
                    } elseif($model->type == 'video') {
                        return 'Видео';
                    } elseif($model->type == 'content') {
                        return 'Текст';
                    }
                    return '-';
                }),
                AdminColumn::custom('Формат', function($model) {
                    if($model->small_format == 1) {
                        return 'Маленький';
                    }
                    return 'Большой';
                }),
                AdminColumnEditable::checkbox('visible','На сайте', 'скрыт')->setLabel('Статус'),
                AdminColumn::order()
            ]);

            $display->setApply(function ($query) {
                $query
                    ->orderBy('order', 'asc')
                ;
            });

            $display->paginate(15);

            return $display;
        });

        // Create And Edit
        $model->onCreateAndEdit(function() {
            $form = AdminForm::panel();
            $form->setHtmlAttribute('enctype', 'multipart/form-data');
            $form->addBody(
                AdminFormElement::select('project_id', 'Проект', Project::class)->setDisplay('caption')->required(),
                AdminFormElement::text('note', 'Примечание'),
                AdminFormElement::select('type', 'Тип', [
                    'image' => 'Фото',
                    'video' => 'Видео',
                    'content'  => 'Текст',
                ])->required()->setSortable(false),
                AdminFormElement::select('small_format', 'Формат', [
                    '0' => 'Большой',
                    '1' => 'Маленький'
                ])->required()->setSortable(false),
                AdminFormElement::images('image', 'Фото')
                    ->setValidationRules([
                        'required_if:type,image',
                        'dimensions:min_width=1160'
                    ])
                    ->addValidationMessage('required_if', 'Выберите изображение(я)')
                    ->addValidationMessage('dimensions', 'Ширина изображения должна не менее 1160 пикселей')
                    ->addValidationRule('required_if:type,image', 'Загрузите фотографию(и)')
                    ->setHelpText('Рекомендованный размер: 2320 x 1480 пикселей (ширина x высота)')

                    ->setSaveCallback(function($file, $path, $filename, $settings) {
                        $res = makeProjectThumbs($file, $path, $filename, $settings);
                        if($res) {
                            $value = $res['path'];
                            $res['path'] = $res['value'];
                            $res['value'] = $value;
                        }
                        return $res;
                    })
                ,
                AdminFormElement::upload('video', 'Видео')
                    ->setValidationRules([
                        'required_if:type,video',
                        'sometimes',
                        'mimetypes:video/mp4,video/webm,video/ogg'
                    ])
                    ->addValidationMessage('required_if', 'Выберите видео в формате: mp4, webm или ogg')
                    ->addValidationMessage('mimetypes', 'Выберите видео в формате: mp4, webm или ogg')
                    ->setView(view('admin.form.project_section_video'))
                ,
                AdminFormElement::ckeditor('content', 'Текст')->addValidationRule('required_if:type,content', 'Введите текст'),
                AdminFormElement::view('admin/form/project_form_js', [], function() {
                    //dd(func_get_args());
                })
            );
            return $form;
        });

        $saving = function(ModelConfiguration $model, ProjectSection $section) {
            //dd($section);
            if($section->type != 'image') {
                if(!is_array($section->image)) {
                    $section->image = @json_decode($section->image);
                }

                // remove images from disk
                if(is_array($section->image)) {
                    foreach($section->image as $img) {
                        $file = public_path($img);
                        if(is_file($file)) {
                            @unlink($file);
                        }
                    }
                }
                $section->image = null;
            } else {
                if(is_array($section->image)) {
                    $section->image = json_encode($section->image);
                }
            }

            if($section->type != 'video') {
                if(!empty($section->video)) {
                    $file = public_path($section->video);
                    if(is_file($file)) {
                        $info = pathinfo($file);
                        @unlink($file);
                        @unlink($info['dirname'] . '/' . $info['filename'] . '.jpg');
                        @unlink($info['dirname'] . '/' . $info['filename'] . '.webm');
                        @unlink($info['dirname'] . '/' . $info['filename'] . '.ogg');
                    }
                }
                $section->video = null;
            }

            if($section->type != 'content') {
                $section->content = null;
            }

            return true;
        };

        $saved = function(ModelConfiguration $model,ProjectSection $section) {
            if($section->type == 'video') {
                set_time_limit(600);
                $ffmpeg = FFMpeg::create();
                $server_path = public_path($section->video);
                $info = pathinfo($server_path);

                $video = $ffmpeg->open($server_path);
                $video
                    ->frame(TimeCode::fromSeconds(3))
                    ->save($info['dirname'] . '/' . $info['filename'] . '.jpg')
                ;

                /*$tmp_path = $info['dirname'] . '/tmp_' . $info['basename'];
                rename($server_path, $tmp_path);
                @unlink($server_path);
                $section->video = trim( str_replace(public_path(), '', $tmp_path), '/' );

                $video = $ffmpeg->open($tmp_path);
                //dd($video->getFFMpegDriver(), $video);

                // preview
                $video
                    ->frame(TimeCode::fromSeconds(3))
                    ->save($info['dirname'] . '/' . $info['filename'] . '.jpg')
                ;

                // mp4, webm and ogg
                $video
                    ->save(
                        (new X264('libfdk_aac')),//->setKiloBitrate(415)->setAudioChannels(2)->setAudioKiloBitrate(96),
                        $info['dirname'] . '/' . $info['filename'] . '.mp4'
                    )
                    ->save(
                        (new WebM()),
                        $info['dirname'] . '/' . $info['filename'] . '.webm'
                    )
                    ->save(
                        (new Ogg()),
                        $info['dirname'] . '/' . $info['filename'] . '.ogg'
                    );

                @unlink($tmp_path);*/

                $section->video = trim( str_replace(public_path(), '', $info['dirname'] . '/' . $info['filename'] . '.mp4'), '/' );
            }
        };

        $model->creating($saving);
        $model->created($saved);
        $model->updating($saving);
        $model->updated($saved);
    })
    ->addMenuPage(ProjectSection::class, 5);