@extends('layouts.app')

@section('content')

    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb',['title' => trans('app.receivers_page_title'),'first_list_item' => trans('app.receivers'),'last_list_item' => trans('app.all_receivers')])
    {{--    end breadcrumb --}}

    <!--Row-->
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="breadcrumb-header justify-content-between">
                        <div class="left-content">
                            <a class="btn ripple btn-primary" href="{{route('receivers.create')}}"><i
                                    class="fe fe-plus me-2"></i>{{ trans('app.add_new_receiver') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-lg-12 col-md-12">
                            <div class="card" id="basic-alert">
                                <div class="card-body">
                                    <div><h6 class="card-title mb-1">Basic Style Tabs</h6>
                                        <p class="text-muted card-sub-title">It is Very Easy to Customize and it uses in
                                            your website apllication.</p></div>
                                    <div class="text-wrap">
                                        <div class="example">
                                            <div class="panel panel-primary tabs-style-1">
                                                <div class=" tab-menu-heading">
                                                    <div class="tabs-menu1"> <!-- Tabs -->
                                                        <ul class="nav panel-tabs main-nav-line">
                                                            <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                                                    data-bs-toggle="tab">Tab 01</a></li>
                                                            <li class="nav-item"><a href="#tab2" class="nav-link"
                                                                                    data-bs-toggle="tab">Tab 02</a></li>
                                                            <li class="nav-item"><a href="#tab3" class="nav-link"
                                                                                    data-bs-toggle="tab">Tab 03</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div
                                                    class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tab1"> blanditiis praesentium
                                                            voluptatum deleniti atque corrupti quos dolores et quas
                                                            molestias excepturi sintaccusamus et iusto odio At vero eos
                                                            et dignissimos ducimus qui occaecati cupiditate non
                                                            provident, similique sunt in culpa qui officia deserunt
                                                            mollitia animi, id est laborum et dolorum fuga. Et harum
                                                            quidem rerum facilis est et expedita distinctio. Nam libero
                                                            tempore, cum soluta nobis est eligendi optio cumque nihil
                                                            impedit quo minus id quod maxime placeat facere possimus,
                                                            omnis voluptas assumenda est, omnis dolor repellendus.
                                                        </div>
                                                        <div class="tab-pane" id="tab2"><p>cum soluta nobis est eligendi
                                                                optio cumque nihil Et harum quidem rerum facilis est et
                                                                expedita distinctio., similique sunt in culpa qui
                                                                officia deserunt mollitia animi, id est laborum et
                                                                dolorum fuga.</p>
                                                            <p>Nam libero tempore, cum soluta nobis est eligendi optio
                                                                cumque nihil Et harum quidem rerum facilis est et
                                                                expedita distinctio. impedit quo minus id quod
                                                                maxime</p>
                                                            <p class="mb-0">placeat facere possimus, omnis voluptas
                                                                assumenda est, omnis dolor repellendus.</p></div>
                                                        <div class="tab-pane" id="tab3"><p>aborum et dolorum fuga. Et
                                                                harum quidem rerum facilis est et expedita distinctio
                                                                cupiditate non provident praesentium</p>
                                                            <p class="mb-0">deserunt mollitia animi, id est laborum et
                                                                dolorum fuga. Et harum quidem rerum facilis est et
                                                                expedita distinctio.similique sunt in culpa qui officia
                                                                Nam libero tempore, cum soluta nobis est eligendi optio
                                                                cumque nihil impedit quo minus id quod maxime placeat
                                                                facere possimus, omnis voluptas assumenda est, omnis
                                                                dolor repellendus.</p></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12"> <!-- div -->
                            <div class="card mg-b-20" id="tabs-style2">
                                <div class="card-body">
                                    <div class="main-content-label mg-b-5"> Basic Style2 Tabs</div>
                                    <p class="mg-b-20">It is Very Easy to Customize and it uses in your website
                                        apllication.</p>
                                    <div class="text-wrap">
                                        <div class="example">
                                            <div class="panel panel-primary tabs-style-2">
                                                <div class=" tab-menu-heading">
                                                    <div class="tabs-menu1"> <!-- Tabs -->
                                                        <ul class="nav panel-tabs main-nav-line">
                                                            <li><a href="#tab4" class="nav-link active"
                                                                   data-bs-toggle="tab">Tab 01</a></li>
                                                            <li><a href="#tab5" class="nav-link" data-bs-toggle="tab">Tab
                                                                    02</a></li>
                                                            <li><a href="#tab6" class="nav-link" data-bs-toggle="tab">Tab
                                                                    03</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tab4"> voluptatum deleniti
                                                            atque corrupti quos dolores et quas molestias excepturi sint
                                                            occaecati cupiditate non provident voluptatum deleniti atque
                                                            corrupti quos dolores et quas molestias excepturi sint
                                                            occaecati cupiditate non provident, similique sunt in culpa
                                                            qui officia deserunt mollitia animi, id est laborum et
                                                            dolorum fuga. Et harum quidem rerum facilis est et expedita
                                                            distinctio. Nam libero tempore, cum soluta nobis est
                                                            eligendi optio cumque nihil impedit quo minus id quod maxime
                                                            placeat facere possimus, omnis voluptas assumenda est, omnis
                                                            dolor repellendus.
                                                        </div>
                                                        <div class="tab-pane" id="tab5"><p>cupiditate non provident
                                                                voluptatum deleniti atque corrupti quos dolores et quas
                                                                atque corrupti quos dolores et quas molestias excepturi
                                                                sint occaecati cupiditate non provident, similique sunt
                                                                in culpa qui officia deserunt mollitia animi, id est
                                                                laborum et dolorum fuga.</p>
                                                            <p>Et harum quidem rerum facilis est et expedita distinctio.
                                                                Nam libero tempore, cum soluta nobis est eligendi optio
                                                                cumque nihil impedit quo minus id quod maxime</p>
                                                            <p class="mb-0">placeat facere possimus, omnis voluptas
                                                                assumenda est, omnis dolor repellendus.</p></div>
                                                        <div class="tab-pane" id="tab6"><p>cupiditate non provident
                                                                voluptatum deleniti atque corrupti quos dolores et quas
                                                                sint occaecati cupiditate non provident,</p>
                                                            <p class="mb-0">scupiditate non provident voluptatum
                                                                deleniti atque corrupti quos dolores et quas dolorum
                                                                fuga. Et harum quidem rerum facilis est et expedita
                                                                distinctio. Nam libero tempore, cum soluta nobis est
                                                                eligendi optio cumque nihil impedit quo minus id quod
                                                                maxime placeat facere possimus, omnis voluptas assumenda
                                                                est, omnis dolor repellendus.</p></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /div -->
                        <div class="col-xl-12"> <!-- div -->
                            <div class="card mg-b-20" id="tabs-style3">
                                <div class="card-body">
                                    <div class="main-content-label mg-b-5"> Basic Style3 Tabs</div>
                                    <p class="mg-b-20">It is Very Easy to Customize and it uses in your website
                                        apllication.</p>
                                    <div class="text-wrap">
                                        <div class="example">
                                            <div class="panel panel-primary tabs-style-3">
                                                <div class="tab-menu-heading">
                                                    <div class="tabs-menu "> <!-- Tabs -->
                                                        <ul class="nav panel-tabs">
                                                            <li class=""><a href="#tab11" class="active"
                                                                            data-bs-toggle="tab"> Tab Style 01</a></li>
                                                            <li><a href="#tab12" data-bs-toggle="tab"> Tab Style 02</a>
                                                            </li>
                                                            <li><a href="#tab13" data-bs-toggle="tab">Tab Style 03</a>
                                                            </li>
                                                            <li><a href="#tab14" data-bs-toggle="tab">Tab Style 04</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="panel-body tabs-menu-body">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tab11"><p>cupiditate non
                                                                provident voluptatum deleniti atque corrupti quos
                                                                dolores et quas atque corrupti quos dolores et quas
                                                                molestias excepturi sint occaecati cupiditate non
                                                                provident, similique sunt in culpa qui officia deserunt
                                                                mollitia animi, id est laborum et dolorum fuga.</p>
                                                            <p class="mb-0">cupiditate non provident voluptatum deleniti
                                                                atque corrupti quos dolores et quas eligendi optio
                                                                cumque nihil impedit quo minus id quod maxime placeat
                                                                facere possimus, omnis voluptas assumenda est, omnis
                                                                dolor repellendus. </p></div>
                                                        <div class="tab-pane" id="tab12"><p> cupiditate non provident
                                                                voluptatum deleniti atque corrupti quos dolores et quas
                                                                est eligendi optio cumque nihil impedit quo minus id
                                                                quod maxime placeat facere possimus, omnis voluptas
                                                                assumenda est, omnis dolor repellendus. </p>
                                                            <p class="mb-0">cupiditate non provident voluptatum deleniti
                                                                atque corrupti quos dolores et quas et quas voluptatum
                                                                deleniti atque corrupti quos dolores et quas molestias
                                                                excepturi sint occaecati cupiditate non provident,
                                                                similique sunt in culpa qui officia deserunt mollitia
                                                                animi, id est laborum et dolorum fuga.</p></div>
                                                        <div class="tab-pane" id="tab13"><p>cupiditate non provident
                                                                voluptatum deleniti atque corrupti quos dolores et quas
                                                                repudiandae sint et molestiae non recusandae</p>
                                                            <p class="mb-0">cupiditate non provident voluptatum deleniti
                                                                atque corrupti quos dolores et quas nobis est eligendi
                                                                optio cumque nihil impedit quo minus id quod maxime
                                                                placeat facere possimus, omnis voluptas assumenda est,
                                                                omnis dolor repellendus. </p></div>
                                                        <div class="tab-pane" id="tab14"><p>cupiditate non provident
                                                                voluptatum deleniti atque corrupti quos dolores et quas
                                                                and demoralized by the charms of pleasure of the moment,
                                                                so blinded by desire</p>
                                                            <p class="mb-0">cupiditate non provident voluptatum deleniti
                                                                atque corrupti quos dolores et quas minus id quod maxime
                                                                placeat facere possimus, omnis voluptas assumenda est,
                                                                omnis dolor repellendus. Temporibus autem quibusdam et
                                                                aut officiis debitis aut rerum necessitatibus </p></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /div -->
                        <div class="col-xl-12"> <!-- div -->
                            <div class="card" id="tabs-style4">
                                <div class="card-body">
                                    <div class="main-content-label mg-b-5"> Vertical Tabs</div>
                                    <p class="mg-b-20">It is Very Easy to Customize and it uses in your website
                                        apllication.</p>
                                    <div class="text-wrap">
                                        <div class="example">
                                            <div class="d-md-flex">
                                                <div class="">
                                                    <div class="panel panel-primary tabs-style-4">
                                                        <div class="tab-menu-heading">
                                                            <div class="tabs-menu "> <!-- Tabs -->
                                                                <ul class="nav panel-tabs me-3">
                                                                    <li class=""><a href="#tab21" class="active"
                                                                                    data-bs-toggle="tab"> Tab Style
                                                                            01</a></li>
                                                                    <li><a href="#tab22" data-bs-toggle="tab"> Tab Style
                                                                            02</a></li>
                                                                    <li><a href="#tab23" data-bs-toggle="tab"> Tab Style
                                                                            03</a></li>
                                                                    <li><a href="#tab24" data-bs-toggle="tab"> Tab Style
                                                                            04</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tabs-style-4 ">
                                                    <div class="panel-body tabs-menu-body">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tab21"><p>Cupiditate non
                                                                    provident voluptatum deleniti atque corrupti quos
                                                                    dolores et quas praesentium voluptatum deleniti
                                                                    atque corrupti quos dolores et quas molestias
                                                                    excepturi sint occaecati cupiditate non provident,
                                                                    similique sunt in culpa qui officia deserunt
                                                                    mollitia animi, id est laborum et dolorum fuga.</p>
                                                                <p>Cupiditate non provident voluptatum deleniti atque
                                                                    corrupti quos dolores et quas praesentium voluptatum
                                                                    deleniti atque corrupti quos dolores et quas
                                                                    molestias excepturi sint occaecati cupiditate non
                                                                    provident, similique sunt in culpa qui officia
                                                                    deserunt mollitia animi, id est laborum et dolorum
                                                                    fuga.</p>
                                                                <p class="mb-0">cupiditate non provident voluptatum
                                                                    deleniti atque corrupti quos dolores et quas Nam
                                                                    libero tempore, cum soluta nobis est eligendi optio
                                                                    cumque nihil impedit quo minus id quod maxime
                                                                    placeat facere possimus, omnis voluptas assumenda
                                                                    est, omnis dolor repellendus. </p></div>
                                                            <div class="tab-pane" id="tab22"><p> Cupiditate non
                                                                    provident voluptatum deleniti atque corrupti quos
                                                                    dolores et quas, cum soluta nobis est eligendi optio
                                                                    cumque nihil impedit quo minus id quod maxime
                                                                    placeat facere possimus, omnis voluptas assumenda
                                                                    est, omnis dolor repellendus. </p>
                                                                <p> Cupiditate non provident voluptatum deleniti atque
                                                                    corrupti quos dolores et quas, cum soluta nobis est
                                                                    eligendi optio cumque nihil impedit quo minus id
                                                                    quod maxime placeat facere possimus, omnis voluptas
                                                                    assumenda est, omnis dolor repellendus. </p>
                                                                <p class="mb-0">cupiditate non provident voluptatum
                                                                    deleniti atque corrupti quos dolores et quas
                                                                    praesentium voluptatum deleniti atque corrupti quos
                                                                    dolores et quas molestias excepturi sint occaecati
                                                                    cupiditate non provident, similique sunt in culpa
                                                                    qui officia deserunt mollitia animi, id est laborum
                                                                    et dolorum fuga.</p></div>
                                                            <div class="tab-pane" id="tab23"><p>Cupiditate non provident
                                                                    voluptatum deleniti atque corrupti quos dolores et
                                                                    quas praesentium voluptatum deleniti et molestiae
                                                                    non recusandae quod maxime placeat facere possimus,
                                                                    omnis voluptas assumenda est, omnis dolor
                                                                    repellendus.</p>
                                                                <p>Cupiditate non provident voluptatum deleniti atque
                                                                    corrupti quos dolores et quas praesentium voluptatum
                                                                    deleniti sint et molestiae non recusandae quod
                                                                    maxime placeat facere possimus, omnis voluptas
                                                                    assumenda est, omnis dolor repellendus.</p>
                                                                <p class="mb-0">Cupiditate non provident voluptatum
                                                                    deleniti atque corrupti quos dolores et quas
                                                                    praesentium voluptatum deleniti impedit quo minus id
                                                                    quod maxime placeat facere possimus, omnis voluptas
                                                                    assumenda est, omnis dolor repellendus. </p></div>
                                                            <div class="tab-pane" id="tab24"><p>Cupiditate non provident
                                                                    voluptatum deleniti atque corrupti quos dolores et
                                                                    quas praesentium voluptatum delenitiof pleasure of
                                                                    the moment, so blinded by desire quod maxime placeat
                                                                    facere possimus, omnis voluptas assumenda est, omnis
                                                                    dolor repellendus.</p>
                                                                <p>Cupiditate non provident voluptatum deleniti atque
                                                                    corrupti quos dolores et quas praesentium voluptatum
                                                                    deleniti of pleasure of the moment, so blinded by
                                                                    desire quod maxime placeat facere possimus, omnis
                                                                    voluptas assumenda est, omnis dolor repellendus.</p>
                                                                <p class="mb-0">Cupiditate non provident voluptatum
                                                                    deleniti atque corrupti quos dolores et quas
                                                                    praesentium voluptatum deleniti facere possimus,
                                                                    omnis voluptas assumenda est, omnis dolor
                                                                    repellendus. Temporibus autem quibusdam et aut
                                                                    officiis debitis aut rerum necessitatibus </p></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /div -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

@endsection
