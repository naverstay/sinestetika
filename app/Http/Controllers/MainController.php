<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\ServiceHomeTag;
use App\Models\Tag;
use App\Models\TagGroup;

use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct(CookieJar $cookieJar)
    {
        $show_start_screen = false;

        if(!isset($_COOKIE['start_logo'])) {
            $show_start_screen = true;
            $cookieJar->queue(cookie('start_logo', 1, 60*60*24*30));
        }

        \View::share('isotop', false);

        \View::share('show_start_screen', $show_start_screen);

        \View::share('all_services', Service::home()->get());
    }

    public function index()
    {
        $data = [];

        //$data['service_tags'] = Tag::byServices()->get();
        $data['service_tags'] = ServiceHomeTag::with(['service','section.tags'])->where('visible', 1)->orderBy('order')->get();
        //dd($data['service_tags']);

        $data['projects'] = Project::home()->take(8)->get();

        return view('site.home', $data);
    }

    public function projects($tags = null) {
        $tag_names = (! is_null($tags) ? explode('/', $tags) : null);

        \View::share('isotop', true);

        \View::share('page_title', 'Проекты');

        $tag_groups = TagGroup::
            whereHas('tags', function($query) {
                return $query->whereHas('projects', function ($query) {
                    return $query->where('projects.visible', 1);
                });
            })
            ->orderBy('tag_groups.order')
            ->get()
        ;

        $tag_groups->map(function($group) use($tag_names) {
            $tag_names = (array)$tag_names;
            $k = FALSE;
            if($tag_names) {
                $k = array_search($group->name, $tag_names);
            }

            if($k !== FALSE) {
                unset($tag_names[$k]);
            } else {
                $tag_names[] = $group->name;
            }

            $group->href = route('projects', implode('/', $tag_names));
            $group->active = ($k !== FALSE ? true : false);
        });


        $filter_tags = Tag::
            whereHas('projects', function($query) {
                return $query->where('projects.visible', 1);
            })
            ->whereHas('groups', function($query) use(&$tag_names) {
                if($tag_names) {
                    $query->whereIn('tag_groups.name', $tag_names);
                }
                return $query;
            })
            ->orderBy('tags.order')
            ->get()
        ;
        $filter_tags->pluck('id')->toArray();


        $projects = Project::home();
        if($filter_tags->count()) {
            $projects = $projects->whereHas('tags', function($query) use(&$filter_tags) {
                return $query->whereIn('tags.id', $filter_tags->pluck('id')->toArray());
            });
        }
        $projects = $projects->take(8)->get();

        $data = [
            'groups' => $tag_groups,
            'selected_groups' => $tag_names,
            'projects' => $projects
        ];

        return view('site.projects', $data);
    }

    public function project($name) {
        $data = [];

        $data['project'] = $project = Project::single($name)->firstOrFail();

        \View::share('page_title', $project->caption);

        $smcnt = 1;
        $i = 0;
        foreach($project->sections as $s) {
            // check
            $valid = true;
            if($s->type == 'video' && ! is_file(public_path($s->video))) {
                $valid = false;
            } elseif($s->type == 'image' && ! sizeof($s->images)) {
                $valid = false;
            }

            if($valid) {
                if ($s->small_format == 1) {
                    $smcnt++;

                    $s->clear = ($smcnt % 3 == 1);
                } else {
                    $smcnt = 1;
                }
            } else {
                $project->sections->splice($i, 1);
                $i--;
            }
            $i++;
        }

        $next_project_id = Project::
        select('id')
            ->where('id', '!=', $project->id)
            ->where('visible', 1)
            ->where('projects.order', '>', $project->order)
            ->orderBy('projects.order')
            ->first()
        ;

        if(! $next_project_id) {
            $next_project_id = Project::
            select('id')
                ->where('id', '!=', $project->id)
                ->where('visible', 1)
                ->orderBy('projects.order')
                ->first()
            ;
        }

        if($next_project_id) {
            $data['next_project'] = Project::single($next_project_id->getKey())->first();
        }

        return view('site.project', $data);
    }

    public function service($name) {
        $service = Service::
            with([
                'sections' => function($query) {
                    return $query->where('visible', 1)->orderBy('order');
                },
            ])
            //->where('visible', 1)
            ->where('name', $name)
            ->firstOrFail()
        ;

        $service->html_caption = $service->caption;
        $service->html_caption = preg_replace('/ +/is', ' ', $service->html_caption);
        $service->html_caption = preg_replace('#( |^)(\S{1,3}) (\S{3,})( |$)#is', "$1$2__$3$4", $service->html_caption);
        $service->html_caption = str_replace(' ', '</span></span><span><span>', $service->html_caption);
        $service->html_caption = '<span><span>'.str_replace('__', ' ', $service->html_caption).'</span></span>';

        \View::share('page_title', $service->caption);

        $projects = Project::home()->whereHas('services', function($query) use($service) {
            return $query->where('id', $service->getKey());
        })->take(2)->get();

        $other_services = Service::home()->where('services.id', '!=', $service->getKey())->select('id', 'name', 'main_caption')->get();

        $data = [
            'service' => $service,
            'services' => $other_services,
            'projects' => $projects
        ];

        return view('site.service', $data);
    }

    public function contacts() {
        \View::share('page_title', 'Контакты');
        return view('site.contacts');
    }
}
