<div class="page-content-wrapper" data-bind="vieworder-active-page-link">

    <!-- BEGIN CONTENT BODY -->

    <div class="page-content">

        <div id="result_message" style="display: none;"></div>

        <div id="result_error_message" style="display: none;"></div>

        <?php if ($this->session->flashdata('message')) {?>

        <div id="result" style="display: none;"></div>

        <?php } else if ($this->session->flashdata('error')) {?>

        <div id="result_error" style="display: none;"></div>

        <?php } else {}?>

        <div class="row">

            <div class="col-md-12">

                <div class="portlet light portlet-fit bordered">

                    <div class="portlet-title">

                        <div class="caption">

                            <span class="caption-subject font-red sbold uppercase">Your Order</span>

                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="portlet-body">
                                <?php if($this->session->userdata('is_admin') == 1) { ?> 
                                    <div class="row">
                                        <div class="col-md-4" style="margin-bottom: 20px">
                                            <div class="post-search-panel">
                                                <!-- <input type="text" id="searchInput" placeholder="Type keywords..." /> -->
                                                <select id="sortBy" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="0">New</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">Completed</option>
                                                    <option value="3">Rejeted</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" id="sortby_year">
                                                <option>Select Year</option>
                                                <?php foreach ($year as $key => $value) {  ?>
                                                    <option value="<?= $value['year'] ?>"><?= $value['year'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                         <div class="col-md-4">
                                            <a  class="btn btn-default " href="<?= base_url('power-of-attorny')?>" title="Power of attorny" target="_blank" style="margin-left: 15px;"><i class="fa fa-print" data-id="'.$row[5].'" ></i></a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <table class="table table-striped  table-bordered" id="order_table">

                                        <thead>

                                            <tr>

                                                <th> OrderID </th>

                                                <th> Full Name </th>

                                                <th> Address </th>

                                                <th> Number Of Item </th>

                                                <th> Status</th>

                                                <!-- <th>Order Status</th> -->

                                                <th> Action </th>

                                                <!-- <th></th> -->

                                            </tr>

                                        </thead>

                                        <tbody>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>