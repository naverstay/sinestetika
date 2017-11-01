<?php

use App\Models\Service;
use App\Models\ServiceHomeTag;
use App\Models\ServiceSection;

use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(
    ServiceHomeTag::class,
    function (ModelConfiguration $model) {
        $model->setTitle('Теги услуг на главной');

        // Display
        $model->onDisplay(function () {
            $display = AdminDisplay::table();

            $display->with(['service', 'section']);

            $display->setColumns([
                AdminColumn::relatedLink('service.caption', 'Услуга'),
                AdminColumn::text('section.caption', 'Раздел'),
                AdminColumnEditable::text('caption', 'Название'),
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
        $model->onCreateAndEdit(function($id=null) {
            $form = AdminForm::panel()->addBody(
                AdminFormElement::select('service_id', 'Услуга')
                    ->setModelForOptions(Service::class)
                    ->setDisplay('caption')
                    ->setLoadOptionsQueryPreparer(function($element, $query) {
                        return $query
                            ->orderBy('order')
                        ;
                    })
                    ->setSortable(false)
                    ->required()
                ,
                AdminFormElement::select('section_id', 'Раздел')
                    ->setModelForOptions(ServiceSection::class)
                    ->setDisplay(function($model) {
                        return $model->srv . ' / ' . $model->caption;
                    })
                    ->setLoadOptionsQueryPreparer(function($element, $query) {
                        return $query
                            ->whereHas('tags')
                            ->select('service_sections.id', 'service_sections.caption', \DB::raw('services.caption as srv'))
                            ->join('services', 'services.id', '=', 'service_id')
                            ->orderBy('services.order')
                            ->orderBy('service_sections.order')
                        ;
                    })
                    ->nullable()
                    ->setSortable(false)
                ,
                AdminFormElement::text('caption', 'Название')->required()
            );

            return $form;
        });
    })
    ->addMenuPage(ServiceHomeTag::class, 60);