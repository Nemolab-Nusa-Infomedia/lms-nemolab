@extends('components.layouts.member.edittambah')

@section('title, data chapter')

@section('back', 'back')

@section('content-data-chapter')
<div class="container tambah my-3 p-5 w-100">
    <h2 class="fw-semibold mb-4" style="color: #faa907">Edit Data</h2>
    <div class="row">
      <form class="col-12" action="{{ route('admin.chapter.edit.update', $chapters->id) }}" method="post"
        enctype="multipart/form-data">
        <div class="row">

          @csrf
          @method('put')
          <div class="col-12">
            <div class="entryarea">
              <input type="text" id="name" name="name" placeholder="" required
              value="{{ $chapters->name }}" />
              <div class="labelline" for="name">Tittle</div>
            </div>
          </div>
          <div class="col-6">
            <a href="" class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim" style="background-color: #faa907">Kirim</a>
          </div>
          <div class="col-6">
            <a href="" class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white btn-batal" style="background-color: gray">Reset</a>
          </div>
        </div>
      </form>
    </div>
</div>
@endsection
