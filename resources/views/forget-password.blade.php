<x-app-layout>

    <main id="login">
        <div class="login-container row">
            
            <x-app-aside-login-register-layout></x-app-aside-login-register-layout>

            <div class="content col col-md-7">
                <div class="form-header">
                    <h4>Reset Akun</h4>
                    <p>Masukan email akun anda dan kami akan mengirimkan kode token.</p>
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
                            <button class="btn btn-main w-100">Kirim</button>
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