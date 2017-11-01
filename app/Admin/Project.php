<?php

use App\Models\Project;
use App\Models\ProjectSection;
use App\Models\ProjectTag;
use App\Models\Service;
use App\Models\Tag;

use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(
    Project::class,
    function (ModelConfiguration $model) {
        $model->setTitle('Проекты');

        // Display
        $model->onDisplay(function () {
            $display = AdminDisplay::table()->setColumns([
                AdminColumn::text('id')->setLabel('ID')->setWidth('40px'),
                AdminColumn::link('caption')->setLabel('Название'),
                AdminColumn::lists('tags.caption', 'Теги'),
                AdminColumn::lists('services.main_caption', 'Услуги'),
                AdminColumnEditable::text('name')->setLabel('Имя для ссылки'),
                AdminColumnEditable::checkbox('visible','На сайте', 'скрыт')->setLabel('Статус'),
                AdminColumn::order()
            ]);
            $display->setApply(function ($query) {
                $query->orderBy('order', 'asc');
            });
            $display->paginate(15);
            return $display;
        });
        // Create And Edit
        $model->onCreateAndEdit(function($id=null) {

            $tabs = AdminDisplay::tabbed();
            $tabs->setTabs(function ($tabbed=null) use(&$id) {
                $tabs = [];

                $tabs[] = AdminDisplay::tab(
                    AdminForm::panel()->addBody(
                        AdminFormElement::text('caption', 'Название')->required(),
                        AdminFormElement::text('name', 'Имя для ссылки')->required(),
                        AdminFormElement::multiselect('tags', 'Теги', Tag::class)
                            ->setDisplay('caption')
                            ->setSortable(false)
                            ->setLoadOptionsQueryPreparer(function($element, $query) {
                                //dd(func_get_args());
                                return $query
                                    ->select(\DB::raw('tags.*'))
                                    ->leftJoin('project_tag', function ($join) use($element) {
                                        $join->on('project_tag.tag_id', '=', 'tags.id');
                                        if($element->getModel()->getKey()) {
                                            $join->where('project_tag.project_id', '=', $element->getModel()->getKey());
                                        }
                                        return $join;
                                    })
                                    ->orderBy(\DB::Raw('(project_tag.project_id IS NOT NULL)'), 'DESC')
                                    ->orderBy('project_tag.order', 'ASC')
                                    ->orderBy('tags.order', 'ASC');
                            })
                            ->setSyncCallback(function($values, $model) {
                                $model->tags()->detach();
                                foreach($values as $k => $v) {
                                    $model->tags()->attach($v, ['order'=>$k]);
                                }
                            })
                        ,
                        AdminFormElement::multiselect('services', 'Услуги', Service::class)
                            ->setDisplay(function($model) {
                                if(! empty($model->main_caption)) {
                                    return $model->main_caption;
                                }
                                return $model->caption;
                            })
                            ->setFetchColumns(['id', 'caption', 'main_caption'])
                            ->setSortable(false)
                        ,
                        AdminFormElement::image('photo', 'Главное фото')
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
                        AdminFormElement::ckeditor('short_descr', 'Короткое описание для списка')->required(),
                        AdminFormElement::ckeditor('descr', 'Описание на странице проекта')
                    )
                )->setLabel('Основная информация');

                if(!is_null($id)) {
                    $sections = AdminDisplay::table();
                    $sections
                        ->setModelClass(ProjectSection::class)
                        ->setApply(function($query) use($id) {
                            $query
                                ->where('project_id', $id)
                                ->orderBy('order', 'asc');
                        })
                        ->setParameter('project_id', $id)
                        ->setColumns(
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
                            AdminColumn::custom('Статус', function($model) {
                                return ($model->visible == 1 ? 'На сайте' : 'скрыт');
                            }),
                            AdminColumn::order()
                        )
                    ;
                    $stab = AdminDisplay::tab($sections)->setLabel('Разделы');

                    $tabs[] = $stab;

                    $tags = AdminDisplay::table();
                    $tags
                        ->setModelClass(ProjectTag::class)
                        ->setApply(function($query) use($id) {
                            $query
                                ->where('project_id', $id)
                                ->orderBy('order', 'asc');
                        })
                        ->setParameter('project_id', $id)
                        ->setColumns(
                            AdminColumn::text('tag.caption', 'Тег'),
                            (new \App\Admin\Extend\CustomOrder())->setQueryPreparer(function($element, $query) {
                                return $query->where('project_id', '=', $element->getModel()->project_id);
                            })
                        )
                    ;
                    $ttab = AdminDisplay::tab($tags)->setLabel('Сортировка тегов');
                    $tabs[] = $ttab;
                }

                return $tabs;
            });

            return $tabs;
        });
    })
    ->addMenuPage(Project::class, 0);
//->setIcon('fa fa-bank');