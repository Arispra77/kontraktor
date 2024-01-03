
var a;
function pass(){
    if(a==1){
        document.getElementById('password').type='password';
        document.getElementById('togglepassword').class="far fa-eye-slash";
a=0;
    }
    else{
        document.getElementById('password').type='text';
        document.getElementById('togglepassword').class="far fa-eye-slash";
a=1;
    }
}
