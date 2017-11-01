<?php

use App\Models\ProjectTag;

use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(
    ProjectTag::class,
    function (ModelConfiguration $model) {
        $model->setTitle('Теги проектов');
        // Display
        $model->onDisplay(function () {
            $display = AdminDisplay::table()->setColumns([
                AdminColumn::text('id')->setLabel('ID')->setWidth('40px'),
                AdminColumn::text('project.caption', 'Проект'),
                AdminColumn::text('tag.caption', 'Тег'),
                AdminColumn::order()
            ]);
            $display->setApply(function ($query) {
                $query
                    ->join('projects', 'projects.id', '=', 'project_id')
                    ->orderBy('projects.order', 'asc')
                    ->orderBy('project_tag.order', 'asc')
                ;
            });
            $display->paginate(15);
            return $display;
        });

        $model->disableDeleting();
    })
;