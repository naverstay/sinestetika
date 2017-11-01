<?php

use App\Models\ServiceSectionTag;

use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(
    ServiceSectionTag::class,
    function (ModelConfiguration $model) {
        $model->setTitle('Теги разделов услуг');
        // Display
        $model->onDisplay(function () {
            $display = AdminDisplay::table()->setColumns([
                AdminColumn::text('id')->setLabel('ID')->setWidth('40px'),
                AdminColumn::text('section.service.caption', 'Услуга'),
                AdminColumn::text('section.caption', 'Раздел'),
                AdminColumn::text('tag.caption', 'Тег'),
                AdminColumn::order()
            ]);
            $display->setApply(function ($query) {
                $query
                    ->join('service_sections', 'service_sections.id', '=', 'service_section_id')
                    ->join('services', 'services.id', '=', 'service_sections.service_id')
                    ->orderBy('services.order', 'asc')
                    ->orderBy('service_sections.order', 'asc')
                    ->orderBy('service_section_tag.order', 'asc')
                ;
            });
            $display->paginate(15);
            return $display;
        });

        $model->disableDeleting();
    })
;