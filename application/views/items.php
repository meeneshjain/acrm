                <style type="text/css">
                    .btn-file {
                      position: relative;
                      overflow: hidden;
                      vertical-align: middle;
                    }
                    .btn-file > input {
                      position: absolute;
                      top: 0;
                      right: 0;
                      width: 100%;
                      height: 100%;
                      margin: 0;
                      font-size: 23px;
                      cursor: pointer;
                      filter: alpha(opacity=0);
                      opacity: 0;

                      direction: ltr;
                    }
                    .fileinput {
                      display: inline-block;
                      margin-bottom: 9px;
                    }
                    .fileinput .form-control {
                      display: inline-block;
                      padding-top: 7px;
                      padding-bottom: 5px;
                      margin-bottom: 0;
                      vertical-align: middle;
                      cursor: text;
                    }
                    .fileinput .thumbnail {
                      display: inline-block;
                      margin-bottom: 5px;
                      overflow: hidden;
                      text-align: center;
                      vertical-align: middle;
                    }
                    .fileinput .thumbnail > img {
                      max-height: 100%;
                    }
                    .fileinput .btn {
                      vertical-align: middle;
                    }
                    .fileinput-exists .fileinput-new,
                    .fileinput-new .fileinput-exists {
                      display: none;
                    }
                    .fileinput-inline .fileinput-controls {
                      display: inline;
                    }
                    .fileinput-filename {
                      display: inline-block;
                      overflow: hidden;
                      vertical-align: middle;
                    }
                    .form-control .fileinput-filename {
                      vertical-align: bottom;
                    }
                    .fileinput.input-group {
                      display: table;
                    }
                    .fileinput.input-group > * {
                      position: relative;
                      z-index: 2;
                    }
                    .fileinput.input-group > .btn-file {
                      z-index: 1;
                    }
                    .fileinput-new.input-group .btn-file,
                    .fileinput-new .input-group .btn-file {
                      border-radius: 0 4px 4px 0;
                    }
                    .fileinput-new.input-group .btn-file.btn-xs,
                    .fileinput-new .input-group .btn-file.btn-xs,
                    .fileinput-new.input-group .btn-file.btn-sm,
                    .fileinput-new .input-group .btn-file.btn-sm {
                      border-radius: 0 3px 3px 0;
                    }
                    .fileinput-new.input-group .btn-file.btn-lg,
                    .fileinput-new .input-group .btn-file.btn-lg {
                      border-radius: 0 6px 6px 0;
                    }
                    .form-group.has-warning .fileinput .fileinput-preview {
                      color: #8a6d3b;
                    }
                    .form-group.has-warning .fileinput .thumbnail {
                      border-color: #faebcc;
                    }
                    .form-group.has-error .fileinput .fileinput-preview {
                      color: #a94442;
                    }
                    .form-group.has-error .fileinput .thumbnail {
                      border-color: #ebccd1;
                    }
                    .form-group.has-success .fileinput .fileinput-preview {
                      color: #3c763d;
                    }
                    .form-group.has-success .fileinput .thumbnail {
                      border-color: #d6e9c6;
                    }
                    .input-group-addon:not(:first-child) {
                      border-left: 0;
                    }
                </style>
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Item List
								</h3>
							</div>

							<div>
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
									<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
										<i class="la la-plus m--hide"></i>
										<i class="la la-ellipsis-h"></i>
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<ul class="m-nav">
														<li class="m-nav__section m-nav__section--first m--hide">
															<span class="m-nav__section-text">
																Quick Actions
															</span>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
																	Activity
																</span>
															</a>
														</li>
														<li class="m-nav__separator m-nav__separator--fit"></li>
														<li class="m-nav__item">
															<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
																Submit
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END: Subheader -->

                    <div class="m-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="-portlet m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet--mobile">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Item List
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill item_modal_open_btn" data-form_type="add">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </li>
                                                <li class="m-portlet__nav-item">
                                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                    				</div>
        							<div class="m-portlet__body">
        								<table class="table table-striped- table-bordered table-hover table-checkable dt_table" id="item_list_dt_table" data-source="<?php echo base_url('items/itemlist'); ?>">
        									<thead>
        										<tr>
        											<th class="no-sort">
        												<input type="checkbox" class="itmckbxAll" onclick="checkAll('itmckbxAll','itmckbx')" name="">
        											</th>
        											<th>
        												Image
        											</th>
        											<th>
        												Code
        											</th>
                                                    <th>
                                                        Name
                                                    </th>
        											<th>
        												Type
        											</th>
                                                    <th>
                                                        Unit
                                                    </th>
                                                    <th>
                                                        GST
                                                    </th>
                                                    <th>
                                                        Create Date
                                                    </th>
                                                   <th class="no-sort">
                                                        Action
                                                    </th>
        										</tr>
        									</thead>
        								</table>
        							</div>
        						</div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="item_modal" tabindex="-1" role="dialog" aria-labelledby="item_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="item_form" action=""  data-parsley-validate>
                                <div class="modal-header">
                                    <h4 class="modal-title item_modal_heading" id="item_modal_lable">
                                        EDIT ITEM DETAIL
                                    </h4>
                                    <button type="button" class="close close_modal_common" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 100px; height: 75px;">
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 75px;"> </div>
                                                    <div>
                                                        <span class="btn default btn-file">
                                                            <span class="fileinput-new"> Select image </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="..."> </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>
                                                    Item Name:
                                                </label>
                                                <input type="hidden" id="item_id" name="id" value="0">
                                                <input required type="text" id="item_name" name="name" class="form-control m-input" placeholder="Enter Item name">
                                            
                                            </div>
                                            <div class="col-lg-4">
                                                <label>
                                                    Item Code:
                                                </label>
                                                <input required type="text" id="item_code" name="code" class="form-control m-input" placeholder="Enter Item Code">
                                            </div>
                                            <div class="col-lg-4">
                                                <label>
                                                    Item Type:
                                                </label>
                                                <select required class="form-control m-input" id="item_type" name="type">
                                                        <option value=""> --Select Type --</option>
                                                        <option value="SERIAL"> SERIAL</option>
                                                        <option value="BATCH"> BATCH</option>
                                                        <option value="NONE"> NONE</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>
                                                    Item Group:
                                                </label>
                                                <input type="text" id="item_group" name="group" class="form-control m-input" placeholder="Enter Item Group">
                                            
                                            </div>

                                            <div class="col-lg-4">
                                                <label>
                                                    Item Price:
                                                </label>
                                                <input type="text" id="item_price" name="price" class="form-control m-input" placeholder="Enter Item price">
                                            </div>

                                            <div class="col-lg-4">
                                                <label>
                                                    Item Unit:
                                                </label>
                                                <input required type="text" id="item_unit" name="unit" class="form-control m-input" placeholder="Enter Item unit">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8">
                                                <label>
                                                    About Item:
                                                </label>
                                                <div class="m-input-icon m-input-icon--right">
                                                    <textarea required class="form-control m-input" id="item_description" name="description" placeholder="About the items" ></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>
                                                    GST Applicable(?)
                                                </label>
                                                <div class="m-checkbox-list">
                                                    <label class="m-checkbox m-checkbox--square">
                                                        <input type="checkbox" id="item_gst" name="is_gst" value="0">
                                                        Is GST
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="item_action_btn"  class="btn btn-primary">
                                       <i class="fa fa-check"></i> Update
                                    </button>
                                    
                                    <button type="button" class="btn btn-danger close_modal_common" data-dismiss="modal">
                                       <i class="fa fa-times"></i> Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>