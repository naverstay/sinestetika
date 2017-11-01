<?php

use App\Models\Service;
use App\Models\ServiceSection;
use App\Models\ServiceSectionTag;
use App\Models\Tag;

use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(
    ServiceSection::class,
    function (ModelConfiguration $model) {
        $model->setTitle('Разделы услуг');

        // Display
        $model->onDisplay(function () {
            $display = AdminDisplay::table();

            $display->with(['tags','service']);

            $display->setColumns([
                AdminColumn::relatedLink('service.caption', 'Услуга'),
                AdminColumnEditable::text('caption', 'Название'),
                AdminColumn::lists('tags.caption', 'Теги'),
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
            $tabs = AdminDisplay::tabbed();
            $tabs->setTabs(function ($tabbed=null) use(&$id) {
                $tabs = [];

                $tabs[] = AdminDisplay::tab(
                    AdminForm::panel()->addBody(
                        AdminFormElement::select('service_id', 'Услуга', Service::class)->setDisplay('caption')->required(),
                        AdminFormElement::text('caption', 'Название')->required(),
                        AdminFormElement::multiselect('tags', 'Теги', Tag::class)
                            ->setDisplay('caption')
                            ->setSortable(false)
                            ->setLoadOptionsQueryPreparer(function($element, $query) {
                                //dd(func_get_args());
                                return $query
                                    ->select(\DB::raw('tags.*'))
                                    ->leftJoin('service_section_tag', function ($join) use($element) {
                                        $join->on('service_section_tag.tag_id', '=', 'tags.id');
                                        if($element->getModel()->getKey()) {
                                            $join->where('service_section_tag.service_section_id', '=', $element->getModel()->getKey());
                                        }
                                        return $join;
                                    })
                                    ->orderBy(\DB::Raw('(service_section_tag.service_section_id IS NOT NULL)'), 'DESC')
                                    ->orderBy('service_section_tag.order', 'ASC')
                                    ->orderBy('tags.order', 'ASC');
                            })
                            ->setSyncCallback(function($values, $model) {
                                $model->tags()->detach();
                                foreach($values as $k => $v) {
                                    $model->tags()->attach($v, ['order'=>$k]);
                                }
                            }),
                        AdminFormElement::ckeditor('descr', 'Описание')->required()
                    )
                )->setLabel('Основная информация');

                if(!is_null($id)) {
                    $tags = AdminDisplay::table();
                    $tags
                        ->setModelClass(ServiceSectionTag::class)
                        ->setApply(function($query) use($id) {
                            $query
                                ->where('service_section_id', $id)
                                ->orderBy('order', 'asc');
                        })
                        ->setParameter('service_section_id', $id)
                        ->setColumns(
                            AdminColumn::text('tag.caption', 'Тег'),
                            (new \App\Admin\Extend\CustomOrder())->setQueryPreparer(function($element, $query) {
                                return $query->where('service_section_id', '=', $element->getModel()->service_section_id);
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
    ->addMenuPage(ServiceSection::class, 55);