<x-app-layout>

    <main id="login">
        <div class="login-container row">

            <x-app-aside-login-register-layout></x-app-aside-login-register-layout>
            
            <div class="content col col-md-7">
                <div class="form-header">
                    <h4>Password Baru</h4>
                    <p>Masukan password baru akun anda.</p>
                </div>
                <div class="form-body">
                    <x-alert></x-alert>
                    <form action="" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukan password baru anda"/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Ulangi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password baru anda"/>
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-main w-100">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>