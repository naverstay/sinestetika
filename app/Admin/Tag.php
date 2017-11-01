<?php

use App\Models\Tag;
use App\Models\TagGroup;

use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(
    Tag::class,
    function (ModelConfiguration $model) {
        $model->setTitle('Теги проектов и услуг');
        // Display
        $model->onDisplay(function () {
            $display = AdminDisplay::table()->setColumns([
                AdminColumn::text('id')->setLabel('ID')->setWidth('40px'),
                AdminColumnEditable::text('caption', 'Название'),
                AdminColumnEditable::text('name', 'Имя для ссылки'),
                AdminColumn::lists('groups.caption', 'Группы'),
                AdminColumnEditable::checkbox('on_main','Да', 'Нет')->setLabel('Отображать на главной'),
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
            $form = AdminForm::panel()->addBody(
                AdminFormElement::text('caption', 'Название')->required(),
                AdminFormElement::text('name', 'Имя для ссылки')->required(),
                AdminFormElement::multiselect('groups', 'Группы', TagGroup::class)->setDisplay('caption')
            );
            return $form;
        });
    })
    ->addMenuPage(Tag::class, 105)
;