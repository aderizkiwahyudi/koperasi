<x-app-layout>

    <main id="login">
        <div class="login-container row">
            
            <x-app-aside-login-register-layout></x-app-aside-login-register-layout>

            <div class="content col col-md-7">
                <div class="form-header">
                    <h4>Selamat datang di <strong>Koperasi</strong></h4>
                    <p>Masuk menggunakan akun anda untuk melanjutkan peminjaman</p>
                </div>
                <div class="form-body">
                    <x-alert></x-alert>
                    <form action="" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Masukan email anda"/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="*********"/>
                        </div>
                        <div class="form-group mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue">
                                        <label class="form-check-label" for="">
                                            Remeber me
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('forget_password') }}">Lupa password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-main w-100">Masuk</button>
                        </div>
                        <div class="form-group text-center">
                            <p class="m-0">Belum mempunyai akun? <a href="{{ route('registration') }}">Daftar Disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>