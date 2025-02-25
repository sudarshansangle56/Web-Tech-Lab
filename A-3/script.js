function  validateForm(){

    let name = document.getElementById("name").value;
    let mob = document.getElementById("mobile").value;
    let age = document.getElementById("age").value;



    if(name.trim() ===""){
        alert("please enter valid name")
    }

    if(mob.length != 10){
               alert("enter valid number");
    }
    if(age < 18){
        console.log("yotr not eligible ok")
        alert("you not eligible");
    }
}