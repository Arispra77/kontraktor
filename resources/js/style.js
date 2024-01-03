
var a;
function pass(){
    if(a==1){
        document.getElementById('Password').type='password';
        document.getElementById('togglePassword').class="far fa-eye-slash";
a=0;
    }
    else{
        document.getElementById('Password').type='text';
        document.getElementById('togglePassword').class="far fa-eye-slash";
a=1;
    }
}