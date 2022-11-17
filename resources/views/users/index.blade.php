@extends('layouts.app', ['page' => __('User'), 'pageSlug' => 'users'])

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> Data User</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>
                  Nama
                </th>
                <th>
                  Email
                </th>
                <th>
                  Role
                </th>
                <th>
                    Edit
                </th>
                
              </tr>
            </thead>
            <tbody>
                @foreach($user as $users)
              <tr>
                <td>{{$users->name}}</td>
                <td>{{$users->email}}</td>
                <td>{{$users->role}}</td>
                <td>
                    @if(Auth::user()->role == "admin")
                     <a href="" class="x" style="color: green;" data-toggle="modal" data-target="#exampleModal23<?php echo $users->id?>"><i class="fas fa-edit">Edit</i></a>
                     @endif</td>
              </tr>
              <div class="modal fade" id="exampleModal23<?php echo $users->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content" style="background-color: rgba(89, 28, 128, 0.719);">
                                    <div class="modal-header">
                                    <h5 class="modal-title text-white" style="width : 100%; font-family: hi" id="exampleModalLabel">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('profile.update') }}" method="post" autocomplete="off">
                                        @csrf
                                        @method('put')
                                            <input type="hidden" class="form-control" name="id" value="{{$users->id}}" placeholder="Qty" id="">
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" class="form-control" name="name" value="{{$users->name}}" placeholder="name" id="">

                                        </div>
                                        <div class="modal-body">
                                            <input type="email" class="form-control" name="email" value="{{$users->email}}" placeholder="email" id="">

                                        </div>
                                            <div class="modal-body">
                                            <select name="role" class="form-control">
                                                <option value="" disabled selected>--Pilih Role--</option>
                                                <option value="admin">Role Admin</option>
                                                <option value="user">Role User</option>
                                            </select>
                                            </div>
                                           <div class="modal-body">
                                            @include('alerts.success', ['key' => 'password_status'])
                    
                                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                                <label>{{ __('Current Password') }}</label>
                                                <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                                @include('alerts.feedback', ['field' => 'old_password'])
                                            </div>
                                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                                <label>{{ __('New Password') }}</label>
                                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                                @include('alerts.feedback', ['field' => 'password'])
                                            </div>
                                            <div class="form-group">
                                                <label>{{ __('Confirm New Password') }}</label>
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                            </div>
                                           </div>
                                        <div class="modal-footer">
                                            <button type="submit" style="width : 100%; font-family: hi" class="btn btn-danger">Yes</button>
                                        </form>
                                      </div>
                                </div>
                                </div>
                            </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
@endsection
