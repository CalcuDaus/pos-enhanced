@extends('layouts.app')
@section('title', $title)
@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ $breadcrumbs[0]['url'] }}">{{ $breadcrumbs[0]['name'] }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            {{ $breadcrumbs[1]['name'] }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end --><!-- [ Main Content ] start -->
    <div class="row">
        <div class="card table-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover tbl-product " id="dt-products">
                        <thead>
                            <tr>
                                <th class="text-end" style="width: 5.181347150259067%;">#</th>
                                <th style="width: 42.09844559585492%;">PRODUCT DETAIL</th>
                                <th style="width: 20.984455958549223%;">CATEGORIES</th>
                                <th class="text-end" style="width: 7.772020725388601%;">PRICE</th>
                                <th class="text-end" style="width: 5.829015544041451%;">QTY</th>
                                <th class="text-center" style="width: 8.095854922279793%;">BRAND</th>
                                <th class="text-center" style="width: 10.038860103626943%;">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-index="0">
                                <td class="text-end">7</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto pe-0"><img src="../assets/images/application/img-prod-1.jpg"
                                                alt="user-image" class="wid-40 rounded"></div>
                                        <div class="col">
                                            <h6 class="mb-1">Apple Series 4 GPS A38 MM Space</h6>
                                            <p class="text-muted f-12 mb-0">Apple Watch SE Smartwatch</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics, Laptop</td>
                                <td class="text-end">$14.59</td>
                                <td class="text-end">70</td>
                                <td class="text-center"><i class="ph-duotone ph-check-circle text-success f-24"
                                        data-bs-toggle="tooltip" data-bs-title="success"></i></td>
                                <td class="text-center"><img src="../assets/images/application/img-prod-brand-1.png"
                                        alt="user-image" class="wid-40">
                                    <div class="prod-action-links">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="View" data-bs-original-title="View"><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                        class="ti ti-eye f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Edit" data-bs-original-title="Edit"><a
                                                    href="../application/ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Delete" data-bs-original-title="Delete"><a href="#"
                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr data-index="1">
                                <td class="text-end">2</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto pe-0"><img src="../assets/images/application/img-prod-2.jpg"
                                                alt="user-image" class="wid-40 rounded"></div>
                                        <div class="col">
                                            <h6 class="mb-1">Boat On-Ear Wireless</h6>
                                            <p class="text-muted f-12 mb-0">Mic(Bluetooth 4.2, Rockerz 450R</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics, Headphones</td>
                                <td class="text-end">$81.99</td>
                                <td class="text-end">45</td>
                                <td class="text-center"><i class="ph-duotone ph-clock-countdown text-warning f-24"
                                        data-bs-toggle="tooltip" data-bs-title="warning"></i></td>
                                <td class="text-center"><img src="../assets/images/application/img-prod-brand-2.png"
                                        alt="user-image" class="wid-40">
                                    <div class="prod-action-links">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="View" data-bs-original-title="View"><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                        class="ti ti-eye f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Edit" data-bs-original-title="Edit"><a
                                                    href="../application/ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Delete" data-bs-original-title="Delete"><a href="#"
                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr data-index="0">
                                <td class="text-end">7</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto pe-0"><img src="../assets/images/application/img-prod-1.jpg"
                                                alt="user-image" class="wid-40 rounded"></div>
                                        <div class="col">
                                            <h6 class="mb-1">Apple Series 4 GPS A38 MM Space</h6>
                                            <p class="text-muted f-12 mb-0">Apple Watch SE Smartwatch</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics, Laptop</td>
                                <td class="text-end">$14.59</td>
                                <td class="text-end">70</td>
                                <td class="text-center"><i class="ph-duotone ph-check-circle text-success f-24"
                                        data-bs-toggle="tooltip" data-bs-title="success"></i></td>
                                <td class="text-center"><img src="../assets/images/application/img-prod-brand-1.png"
                                        alt="user-image" class="wid-40">
                                    <div class="prod-action-links">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="View" data-bs-original-title="View"><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                        class="ti ti-eye f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Edit" data-bs-original-title="Edit"><a
                                                    href="../application/ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Delete" data-bs-original-title="Delete"><a href="#"
                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr data-index="1">
                                <td class="text-end">2</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto pe-0"><img src="../assets/images/application/img-prod-2.jpg"
                                                alt="user-image" class="wid-40 rounded"></div>
                                        <div class="col">
                                            <h6 class="mb-1">Boat On-Ear Wireless</h6>
                                            <p class="text-muted f-12 mb-0">Mic(Bluetooth 4.2, Rockerz 450R</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics, Headphones</td>
                                <td class="text-end">$81.99</td>
                                <td class="text-end">45</td>
                                <td class="text-center"><i class="ph-duotone ph-clock-countdown text-warning f-24"
                                        data-bs-toggle="tooltip" data-bs-title="warning"></i></td>
                                <td class="text-center"><img src="../assets/images/application/img-prod-brand-2.png"
                                        alt="user-image" class="wid-40">
                                    <div class="prod-action-links">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="View" data-bs-original-title="View"><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                        class="ti ti-eye f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Edit" data-bs-original-title="Edit"><a
                                                    href="../application/ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Delete" data-bs-original-title="Delete"><a href="#"
                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr data-index="0">
                                <td class="text-end">7</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto pe-0"><img src="../assets/images/application/img-prod-1.jpg"
                                                alt="user-image" class="wid-40 rounded"></div>
                                        <div class="col">
                                            <h6 class="mb-1">Apple Series 4 GPS A38 MM Space</h6>
                                            <p class="text-muted f-12 mb-0">Apple Watch SE Smartwatch</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics, Laptop</td>
                                <td class="text-end">$14.59</td>
                                <td class="text-end">70</td>
                                <td class="text-center"><i class="ph-duotone ph-check-circle text-success f-24"
                                        data-bs-toggle="tooltip" data-bs-title="success"></i></td>
                                <td class="text-center"><img src="../assets/images/application/img-prod-brand-1.png"
                                        alt="user-image" class="wid-40">
                                    <div class="prod-action-links">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="View" data-bs-original-title="View"><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                        class="ti ti-eye f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Edit" data-bs-original-title="Edit"><a
                                                    href="../application/ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Delete" data-bs-original-title="Delete"><a href="#"
                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr data-index="1">
                                <td class="text-end">2</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto pe-0"><img src="../assets/images/application/img-prod-2.jpg"
                                                alt="user-image" class="wid-40 rounded"></div>
                                        <div class="col">
                                            <h6 class="mb-1">Boat On-Ear Wireless</h6>
                                            <p class="text-muted f-12 mb-0">Mic(Bluetooth 4.2, Rockerz 450R</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics, Headphones</td>
                                <td class="text-end">$81.99</td>
                                <td class="text-end">45</td>
                                <td class="text-center"><i class="ph-duotone ph-clock-countdown text-warning f-24"
                                        data-bs-toggle="tooltip" data-bs-title="warning"></i></td>
                                <td class="text-center"><img src="../assets/images/application/img-prod-brand-2.png"
                                        alt="user-image" class="wid-40">
                                    <div class="prod-action-links">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="View" data-bs-original-title="View"><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                        class="ti ti-eye f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Edit" data-bs-original-title="Edit"><a
                                                    href="../application/ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Delete" data-bs-original-title="Delete"><a href="#"
                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr data-index="0">
                                <td class="text-end">7</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto pe-0"><img src="../assets/images/application/img-prod-1.jpg"
                                                alt="user-image" class="wid-40 rounded"></div>
                                        <div class="col">
                                            <h6 class="mb-1">Apple Series 4 GPS A38 MM Space</h6>
                                            <p class="text-muted f-12 mb-0">Apple Watch SE Smartwatch</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics, Laptop</td>
                                <td class="text-end">$14.59</td>
                                <td class="text-end">70</td>
                                <td class="text-center"><i class="ph-duotone ph-check-circle text-success f-24"
                                        data-bs-toggle="tooltip" data-bs-title="success"></i></td>
                                <td class="text-center"><img src="../assets/images/application/img-prod-brand-1.png"
                                        alt="user-image" class="wid-40">
                                    <div class="prod-action-links">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="View" data-bs-original-title="View"><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                        class="ti ti-eye f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Edit" data-bs-original-title="Edit"><a
                                                    href="../application/ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Delete" data-bs-original-title="Delete"><a href="#"
                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr data-index="1">
                                <td class="text-end">2</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto pe-0"><img src="../assets/images/application/img-prod-2.jpg"
                                                alt="user-image" class="wid-40 rounded"></div>
                                        <div class="col">
                                            <h6 class="mb-1">Boat On-Ear Wireless</h6>
                                            <p class="text-muted f-12 mb-0">Mic(Bluetooth 4.2, Rockerz 450R</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics, Headphones</td>
                                <td class="text-end">$81.99</td>
                                <td class="text-end">45</td>
                                <td class="text-center"><i class="ph-duotone ph-clock-countdown text-warning f-24"
                                        data-bs-toggle="tooltip" data-bs-title="warning"></i></td>
                                <td class="text-center"><img src="../assets/images/application/img-prod-brand-2.png"
                                        alt="user-image" class="wid-40">
                                    <div class="prod-action-links">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="View" data-bs-original-title="View"><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                        class="ti ti-eye f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Edit" data-bs-original-title="Edit"><a
                                                    href="../application/ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Delete" data-bs-original-title="Delete"><a href="#"
                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr data-index="0">
                                <td class="text-end">7</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto pe-0"><img src="../assets/images/application/img-prod-1.jpg"
                                                alt="user-image" class="wid-40 rounded"></div>
                                        <div class="col">
                                            <h6 class="mb-1">Apple Series 4 GPS A38 MM Space</h6>
                                            <p class="text-muted f-12 mb-0">Apple Watch SE Smartwatch</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics, Laptop</td>
                                <td class="text-end">$14.59</td>
                                <td class="text-end">70</td>
                                <td class="text-center"><i class="ph-duotone ph-check-circle text-success f-24"
                                        data-bs-toggle="tooltip" data-bs-title="success"></i></td>
                                <td class="text-center"><img src="../assets/images/application/img-prod-brand-1.png"
                                        alt="user-image" class="wid-40">
                                    <div class="prod-action-links">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="View" data-bs-original-title="View"><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                        class="ti ti-eye f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Edit" data-bs-original-title="Edit"><a
                                                    href="../application/ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Delete" data-bs-original-title="Delete"><a href="#"
                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr data-index="1">
                                <td class="text-end">2</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto pe-0"><img src="../assets/images/application/img-prod-2.jpg"
                                                alt="user-image" class="wid-40 rounded"></div>
                                        <div class="col">
                                            <h6 class="mb-1">Boat On-Ear Wireless</h6>
                                            <p class="text-muted f-12 mb-0">Mic(Bluetooth 4.2, Rockerz 450R</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Electronics, Headphones</td>
                                <td class="text-end">$81.99</td>
                                <td class="text-end">45</td>
                                <td class="text-center"><i class="ph-duotone ph-clock-countdown text-warning f-24"
                                        data-bs-toggle="tooltip" data-bs-title="warning"></i></td>
                                <td class="text-center"><img src="../assets/images/application/img-prod-brand-2.png"
                                        alt="user-image" class="wid-40">
                                    <div class="prod-action-links">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="View" data-bs-original-title="View"><a href="#"
                                                    class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="offcanvas" data-bs-target="#productOffcanvas"><i
                                                        class="ti ti-eye f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Edit" data-bs-original-title="Edit"><a
                                                    href="../application/ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a></li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                aria-label="Delete" data-bs-original-title="Delete"><a href="#"
                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
