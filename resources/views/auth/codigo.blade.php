@extends('layouts.app')

@section('codigo')

<style>
    .background-radial-gradient {
      background-color: hsl(218, 41%, 15%);
      background-image: radial-gradient(650px circle at 0% 0%,
          hsl(218, 41%, 35%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%),
        radial-gradient(1250px circle at 100% 100%,
          hsl(218, 41%, 45%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%);
    }
    body{
        background-color: #E3F2FD;
      }
      
.text {
  text-align: center;
  color: white;
  font-size: 18px;
}

/**
* ! style rules for form section
**/


.title {
  font-size: 25px;
  font-weight: bold;
  margin-bottom: 20px;
}

form div input {
  width: 100%;
  height: 40px;
  border-radius: 8px;
  outline: none;
  border: 2px solid #c4c4c4;
  padding: 0 30px;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 5px;
}

form div {
  position: relative;
  margin-bottom: 15px;
}

input:focus {
  border: 2px solid #f2796e;
}

/**
* ! style rules for social section
**/

.btn {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  gap: 15px;
}

.btn-1,
.btn-2 {
  padding: 10px 5px;
  width: 100%;
  display: flex;
  gap: 15px;
  justify-content: center;
  align-items: center;
  border: 2px solid #c4c4c4;
  border-radius: 8px;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
  cursor: pointer;
}

.btn-2 {
  background-color: #4f70b5;
  color: white;
  border: 2px solid #4f70b5;
}

.or {
  text-align: center;
}

.question {
  font-size: 15px;
}

span {
  color: #f2796e;
  cursor: pointer;
}

/**
* ! style rules for form icons
**/

form div i {
  position: absolute;
  padding: 10px;
}

.success-icon,
.failure-icon {
  right: 0;
  opacity: 0;
}

.failure-icon,
.error {
  color: red;
}

.success-icon {
  color: green;
}

.error {
  font-size: 14.5px;
  margin-top: 5px;
}

/**
* ! style rules for button 
**/

button {
  margin-top: 15px;
  width: 100%;
  height: 45px;
  background-color: #f2796e;
  border: 2px solid #f2796e;
  border-radius: 8px;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
  transition: all 0.1s ease;
}

button:hover {
  opacity: 0.8;
}

/**
* ! Media Queries are here
**/

@media (max-width: 900px) {
  .container {
    flex-direction: column;
  }

  form,
  .content {
    width: 100%;
  }

  .btn {
    flex-direction: column;
  }
  .image {
    height: 70vh;
  }
}

@media (max-width: 425px) {
  form {
    padding: 20px;
  }
}

</style>
<section class="background-radial-gradient overflow-hidden" style="background-color: #20B2AA;">
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              

              <form id="form">
                <div class="social">
                  <div class="title">Get Started</div>
                  <div class="question">
                    Already Have an Account? <br />
                    <span>Sign In</span>
                  </div>
            
                  <div class="btn">
                    <div class="btn-1">
                      <img src="https://img.icons8.com/color/30/000000/google-logo.png" />
                      Sign Up
                    </div>
                    <div class="btn-2">
                      <img src="https://img.icons8.com/ios-filled/30/ffffff/facebook-new.png" />
                      Sign Up
                    </div>
                  </div>
            
                  <div class="or">Or</div>
                </div>
            
                <!-- /** 
                      * ! user name Input here
                     **/ -->
            
                <div>
                  <label for="username">User Name</label>
                  <i class="fas fa-user"></i>
                  <input type="text" name="username" id="username" placeholder="Joy Shaheb" />
                  <i class="fas fa-exclamation-circle failure-icon"></i>
                  <i class="far fa-check-circle success-icon"></i>
                  <div class="error"></div>
                </div>
            
                <!-- /** 
                      * ! Email Input here
                     **/ -->
            
                <div>
                  <label for="email">Email</label>
                  <i class="far fa-envelope"></i>
                  <input type="email" name="email" id="email" placeholder="abc@gmail.com" />
                  <i class="fas fa-exclamation-circle failure-icon"></i>
                  <i class="far fa-check-circle success-icon"></i>
                  <div class="error"></div>
                </div>
            
                <!-- /** 
                      * ! Password Input here
                     **/ -->
            
                <div>
                  <label for="password">Password</label>
                  <i class="fas fa-lock"></i>
                  <input type="password" name="password" id="password" placeholder="Password here" />
                  <i class="fas fa-exclamation-circle failure-icon"></i>
                  <i class="far fa-check-circle success-icon"></i>
                  <div class="error"></div>
                </div>
            
                <button type="submit" id="submit">Submit</button>
              </form>
              
              
            {{--   <form action="" class="mt-4" method="POST">
                @csrf
                <h4 class="mb-3">Intruzca su codigo:</h4>
                @if(isset($incorrecto))
                  @if($incorrecto=='Incorrecto')
                  <h4 style="color: crimson">El Codigo no Coincide <br> <small>Intentelo otra vez</small></h4>
                  @endif
                @endif
                <div class="form-group">
                  <input type="text" class="form-control" name="codigo" placeholder="codigo">
                </div>

                <div class="form-group">
                    <h4 class="mb-3">Nueva contraseña:</h4>
                    <input type="password" class="form-control" name="newpass" id="newpass" onclick="validarpass()">
                </div>

                <div class="form-group">
                    <h4 class="mb-3">Repita Contraseña:</h4>
                    <input type="password" class="form-control" name="confpass" id="confpass" >
                </div>
            <br>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">Actualizar Password</button>
                </div>
                <br>
                <div class="form-group other_auth_links">
                    <a class="" href="{{ route('login.index') }}"><-Volver</a>
                </div>
              </form> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script >
  
let id = (id) => document.getElementById(id);

let classes = (classes) => document.getElementsByClassName(classes);

let username = id("username"),
  email = id("email"),
  password = id("password"),
  form = id("form"),
  errorMsg = classes("error"),
  successIcon = classes("success-icon"),
  failureIcon = classes("failure-icon");

// Adding the submit event Listener

form.addEventListener("submit", (e) => {
  e.preventDefault();

  engine(username, 0, "Username cannot be blank");
  engine(email, 1, "Email cannot be blank");
  engine(password, 2, "Password cannot be blank");
});

// engine function which will do all the works

let engine = (id, serial, message) => {
  if (id.value.trim() === "") {
    errorMsg[serial].innerHTML = message;
    id.style.border = "2px solid red";

    // icons
    failureIcon[serial].style.opacity = "1";
    successIcon[serial].style.opacity = "0";
  } else {
    errorMsg[serial].innerHTML = "";
    id.style.border = "2px solid green";

    // icons
    failureIcon[serial].style.opacity = "0";
    successIcon[serial].style.opacity = "1";
  }
};

  </script>

@endsection