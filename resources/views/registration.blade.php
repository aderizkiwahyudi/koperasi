<x-app-layout>

    <main id="login">
        <div class="login-container row">
            
            <x-app-aside-login-register-layout></x-app-aside-login-register-layout>

            <div class="content col col-md-7">
                <div class="form-header">
                    <h4>Selamat datang di <strong>Koperasi</strong></h4>
                    <p>Daftar akun untuk memulai peminjaman</p>
                </div>
                <div class="form-body">
                    <x-alert></x-alert>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukan nama anda"/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukan email anda"/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="*********"/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">ID Card </label>
                            <input type="file" name="file" id="file" class="form-control" placeholder="Masukan nama anda"/>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" required checked>
                                <label class="form-check-label" for="">
                                    Syarat & Ketentuan
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-main w-100">Daftar</button>
                        </div>
                        <div class="form-group text-center">
                            <p class="m-0">Sudah mempunyai akun? <a href="{{ route('login') }}">Masuk Disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>