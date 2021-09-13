@extends('layouts.admin-layout')

@section('content')


                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3><i class="fas fa-chart-line"></i></i> Users Activity</h3>
                            </div>
                            <select id="act" class="form-control">
                                <option value="0">Sort By Date</option>
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>

                            <div class="card-body">

                                <table class="table table-responsive-xl table-striped" id="ispisLoga">

                                </table>

                            </div>
                        </div>
                        <!-- end card-->
                    </div>
                </div>
                <!-- end row -->

                {{$activities->links('vendor.pagination.bootstrap-4')}}
@endsection
