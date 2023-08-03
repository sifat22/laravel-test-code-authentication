@extends('admins.admin_master')
@section('index')


<div class="page-content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-2"></div>
            <div class="col-lg-6">
                <div class="card"><br>
                <center>
                    <img class="card-img-top img-fluid rounded-circle avatar-xl"  src="{{ (!empty($adminData->profile_image))? url('upload_image/admin_image/'.$adminData->profile_image):url('upload_image/admin_image/no_image.jpg') }}" alt="Card image cap"> 
                </center>
                    <div class="card-body">
                        <h4 class="card-title">Name : {{$adminData->name}}</h4>
                        <h4 class="card-title">Name : {{$adminData->email}}</h4>
                        <h4 class="card-title">Name : {{$adminData->username}}</h4>
                        <hr>
                        <a href="{{route('admin.edit.profile')}}" class="btn btn-info btn-rounded waves-effect waves-light">Edit Profile</a>
                      
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>