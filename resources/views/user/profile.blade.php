@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="section-header">
    <h1>Profile</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Profile</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">{{ auth()->user()->name }}</h2>
    <p class="section-lead">
      Change information about yourself on this page.
    </p>

    <div class="row mt-sm-4">
      <div class="col-12 col-md-12 col-lg-5">
        <div class="card profile-widget">
          <div class="profile-widget-header">                     
            <img alt="image" src="{{asset('public/profile' . '/' . Auth()->user()->avatar)}}" class="rounded-circle profile-widget-picture">
            <div class="profile-widget-items">
              <div class="profile-widget-item">
                <div class="profile-widget-item-label">Posts</div>
                <div class="profile-widget-item-value">64</div>
              </div>
              <div class="profile-widget-item">
                <div class="profile-widget-item-label">Followers</div>
                <div class="profile-widget-item-value">3,4K</div>
              </div>
              <div class="profile-widget-item">
                <div class="profile-widget-item-label">Following</div>
                <div class="profile-widget-item-value">1,1K</div>
              </div>
            </div>
          </div>
          <div class="profile-widget-description">
            <div class="profile-widget-name">{{ auth()->user()->name }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> Web Developer</div></div>
              Achmad Ilham Mubarok Al-ghifsri
          </div>
          <div class="card-footer text-center">
            <div class="font-weight-bold mb-2">Follow Andy</div>
            <a href="#" class="btn btn-social-icon btn-facebook mr-1">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="btn btn-social-icon btn-twitter mr-1">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="btn btn-social-icon btn-github mr-1">
              <i class="fab fa-github"></i>
            </a>
            <a href="#" class="btn btn-social-icon btn-instagram">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
          <form action="{{route('user.update', Auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
            <div class="card-header">
              <h4>Edit Profile</h4>
            </div>
            <div class="card-body">
                <div class="row">                               
                  <div class="form-group col-md-12 col-12">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ Auth()->user()->name }}">
                    <div class="invalid-feedback">
                      Please fill in the first name
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12 col-12">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ Auth()->user()->email }}">
                    <div class="invalid-feedback">
                      Please fill in the email
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12 col-12">
                    <label>Avatar</label>
                    <input type="file" class="form-control" name="avatar">
                    <div class="tampil-gambar">
                      <img src="{{asset('public/profile' . '/' . Auth()->user()->avatar)}}" width="200px" height="200px">
                    </div>
                    <div class="invalid-feedback">
                      Please fill in the email
                    </div>
                  </div>
                </div>

            </div>
            <div class="card-footer text-right">
              <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection