<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Dashboard</h4>

                    <span class="float-right loggedin">welcome, <strong><?php echo e(ucwords(Auth::user()->name)); ?></strong> [
                        <?php if(Auth::user()->isAdmin==1): ?>
                                Admin
                              <?php else: ?> 
                                Employee
                              <?php endif; ?>
                        ]</span>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <a href="">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Companies</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fi-briefcase"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <a href="">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Clients</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-user-md"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <a href="">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Employees</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-user-o"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <a href="">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Jobs</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-briefcase"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <a href="">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Time Entry</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <a href="">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Expense</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

        </div>



        <div class="row">
            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title mb-4">Messages</h4>

                    <div class="inbox-widget slimscroll" style="max-height: 370px;">
                        <a href="#">
                            <div class="inbox-item">
                                <div class="inbox-item-img"><img src="assets/images/users/avatar-1.jpg" class="rounded-circle bx-shadow-lg" alt=""></div>
                                <p class="inbox-item-author">Chadengle</p>
                                <p class="inbox-item-text">Hey! there I'm available...</p>
                                <p class="inbox-item-date">13:40 PM</p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="inbox-item">
                                <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle bx-shadow-lg" alt=""></div>
                                <p class="inbox-item-author">Tomaslau</p>
                                <p class="inbox-item-text">I've finished it! See you so...</p>
                                <p class="inbox-item-date">13:34 PM</p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="inbox-item">
                                <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg" class="rounded-circle bx-shadow-lg" alt=""></div>
                                <p class="inbox-item-author">Stillnotdavid</p>
                                <p class="inbox-item-text">This theme is awesome!</p>
                                <p class="inbox-item-date">13:17 PM</p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="inbox-item">
                                <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg" class="rounded-circle bx-shadow-lg" alt=""></div>
                                <p class="inbox-item-author">Kurafire</p>
                                <p class="inbox-item-text">Nice to meet you</p>
                                <p class="inbox-item-date">12:20 PM</p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="inbox-item">
                                <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg" class="rounded-circle bx-shadow-lg" alt=""></div>
                                <p class="inbox-item-author">Shahedk</p>
                                <p class="inbox-item-text">Hey! there I'm available...</p>
                                <p class="inbox-item-date">10:15 AM</p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="inbox-item">
                                <div class="inbox-item-img"><img src="assets/images/users/avatar-6.jpg" class="rounded-circle bx-shadow-lg" alt=""></div>
                                <p class="inbox-item-author">Adhamdannaway</p>
                                <p class="inbox-item-text">This theme is awesome!</p>
                                <p class="inbox-item-date">9:56 AM</p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="inbox-item">
                                <div class="inbox-item-img"><img src="assets/images/users/avatar-8.jpg" class="rounded-circle bx-shadow-lg" alt=""></div>
                                <p class="inbox-item-author">Arashasghari</p>
                                <p class="inbox-item-text">Hey! there I'm available...</p>
                                <p class="inbox-item-date">10:15 AM</p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="inbox-item">
                                <div class="inbox-item-img"><img src="assets/images/users/avatar-9.jpg" class="rounded-circle bx-shadow-lg" alt=""></div>
                                <p class="inbox-item-author">Joshaustin</p>
                                <p class="inbox-item-text">I've finished it! See you so...</p>
                                <p class="inbox-item-date">9:56 AM</p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title mb-4">Latest Comments</h4>

                    <div class="comment-list slimscroll" style="max-height: 370px;">
                        <a href="#">
                            <div class="comment-box-item">
                                <div class="badge badge-pill badge-success">Ubold - Admin</div>
                                <p class="commnet-item-date">1 month ago</p>
                                <h6 class="commnet-item-msg">Do you have any plans to add a vertical menu?</h6>
                                <p class="commnet-item-user">Ubold User</p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="comment-box-item">
                                <div class="badge badge-pill badge-warning">Adminox - Admin</div>
                                <p class="commnet-item-date">1 month ago</p>
                                <h6 class="commnet-item-msg">Hello, what is your plan to upgrade Bootstrap 4 versions? Beta or wait for stable?</h6>
                                <p class="commnet-item-user">Ubold User</p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="comment-box-item">
                                <div class="badge badge-pill badge-primary">Staro - Landing</div>
                                <p class="commnet-item-date">1 month ago</p>
                                <h6 class="commnet-item-msg">Hi coderthemes – do you have PSD for this admin UI? I could really use it.</h6>
                                <p class="commnet-item-user">Ubold User</p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="comment-box-item">
                                <div class="badge badge-pill badge-dark">Ubold - Admin</div>
                                <p class="commnet-item-date">1 month ago</p>
                                <h6 class="commnet-item-msg">Do you have any plans to add a vertical menu?</h6>
                                <p class="commnet-item-user">Ubold User</p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title mb-4">Last Transactions</h4>

                    <ul class="list-unstyled transaction-list slimscroll mb-0" style="max-height: 370px;">
                        <li>
                            <i class="dripicons-arrow-down text-success"></i>
                            <span class="tran-text">Advertising</span>
                            <span class="pull-right text-success tran-price">+$230</span>
                            <span class="pull-right text-muted">07/09/2017</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="dripicons-arrow-up text-danger"></i>
                            <span class="tran-text">Support licence</span>
                            <span class="pull-right text-danger tran-price">-$965</span>
                            <span class="pull-right text-muted">07/09/2017</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="dripicons-arrow-down text-success"></i>
                            <span class="tran-text">Extended licence</span>
                            <span class="pull-right text-success tran-price">+$830</span>
                            <span class="pull-right text-muted">07/09/2017</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="dripicons-arrow-down text-success"></i>
                            <span class="tran-text">Advertising</span>
                            <span class="pull-right text-success tran-price">+$230</span>
                            <span class="pull-right text-muted">05/09/2017</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="dripicons-arrow-up text-danger"></i>
                            <span class="tran-text">New plugins added</span>
                            <span class="pull-right text-danger tran-price">-$452</span>
                            <span class="pull-right text-muted">05/09/2017</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="dripicons-arrow-down text-success"></i>
                            <span class="tran-text">Google Inc.</span>
                            <span class="pull-right text-success tran-price">+$230</span>
                            <span class="pull-right text-muted">04/09/2017</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="dripicons-arrow-up text-danger"></i>
                            <span class="tran-text">Facebook Ad</span>
                            <span class="pull-right text-danger tran-price">-$364</span>
                            <span class="pull-right text-muted">03/09/2017</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="dripicons-arrow-down text-success"></i>
                            <span class="tran-text">New sale</span>
                            <span class="pull-right text-success tran-price">+$230</span>
                            <span class="pull-right text-muted">03/09/2017</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="dripicons-arrow-down text-success"></i>
                            <span class="tran-text">Advertising</span>
                            <span class="pull-right text-success tran-price">+$230</span>
                            <span class="pull-right text-muted">29/08/2017</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="dripicons-arrow-up text-danger"></i>
                            <span class="tran-text">Support licence</span>
                            <span class="pull-right text-danger tran-price">-$854</span>
                            <span class="pull-right text-muted">27/08/2017</span>
                            <span class="clearfix"></span>
                        </li>
                    </ul>

                </div>
            </div>

        </div>


    </div> <!-- container -->
</div> <!-- content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>