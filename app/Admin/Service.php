<?php

use App\Models\Service;
use App\Models\ServiceSection;

use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(
    Service::class,
    function (ModelConfiguration $model) {
        $model->setTitle('Услуги');
        // Display
        $model->onDisplay(function () {
            $display = AdminDisplay::table();
            $display->with(['sections', 'sections.tags']);
            $display->setColumns([
                AdminColumn::text('id')->setLabel('ID')->setWidth('40px'),
                AdminColumn::link('caption')->setLabel('Название'),
                AdminColumn::custom('Теги', function($model) {
                    $tags_arr = $model->sections->pluck('tags');
                    $tags = \Illuminate\Support\Collection::make();
                    foreach($tags_arr as $_tags) {
                        $tags = $tags->merge($_tags);
                    }
                    unset($tags_arr);

                    return view('admin.column.lists', [
                        'values' => $tags->pluck('caption')
                    ]);
                }),
                AdminColumnEditable::text('name')->setLabel('Имя для ссылки'),
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
                        AdminFormElement::text('main_caption', 'Название для главной'),
                        AdminFormElement::text('land_caption', 'Название для разводящей'),
                        AdminFormElement::ckeditor('main_descr', 'Описание для главной')->required(),
                        AdminFormElement::ckeditor('short_descr', 'Описание для разводящей')->required(),
                        AdminFormElement::ckeditor('descr', 'Вступительное описание на странице услуги')
                    )
                )->setLabel('Основная информация');

                if(!is_null($id) ) {
                    $sections = AdminDisplay::table();
                    $sections
                        ->setModelClass(ServiceSection::class)
                        ->setApply(function($query) use($id) {
                            $query
                                ->where('service_id', $id)
                                ->orderBy('order', 'asc');
                        })
                        ->setParameter('service_id', $id)
                        ->setColumns(
                            AdminColumn::text('caption', 'Название'),
                            AdminColumn::lists('tags.caption', 'Теги'),
                            AdminColumn::custom('Статус', function($model) {
                                return ($model->visible == 1 ? 'На сайте' : 'скрыт');
                            }),
                            AdminColumn::order()
                        )
                    ;
                    $stab = AdminDisplay::tab($sections)->setLabel('Разделы');

                    $tabs[] = $stab;
                }

                return $tabs;
            });

            return $tabs;
        });
    })
    ->addMenuPage(Service::class, 50);
//->setIcon('fa fa-bank');