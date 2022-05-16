<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>365gram</title>
    <style>
        /****************** verify page old ***************/
       /* a class for .welcome in verify page */
       .verify-box {
           /* background-color: #fff; */
           /* z-index: -1; */
           border-radius: 10px;
           padding: 5%;
           /* position: relative; */
           /* box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16); */
           /* width: 50%; */
   
          display: block;
          margin: auto;
          /* width: 90%; */
       }
       
       .verify-nav {
           width: 100%;
           position: fixed;
           top: 0px;
           z-index: 12;
           padding: 0px 5px 13px 5px;
           border-collapse: separate;
           /* border-bottom: 0.12rem solid #2c4b44; */
           height: 65px;
       
       }
       
       .previous-verify {
           display: flex;
           flex-direction: row-reverse;
           justify-content: flex-start;
           padding-top: 25px;
           padding-left: 10px;
           padding: 25px 15px 25px 10px;
       }
       
       .verify-title {
           text-align: center;
           direction: rtl;
           /* font-weight: bold; */
           font-size: 1.1rem;
           padding: 0 0 3%;
       }
       
       .form-verify {
           margin-top: 15vh;
           direction: ltr;
           display: block;
           margin: auto;
       }
       
       .input-verify {
           background-color: transparent;
           border-top: transparent;
           border-left: transparent;
           border-right: transparent;
           outline: none;
           margin: 0% 2%;
           margin-bottom: 3%;
           border-bottom: 1px solid #738788;
           /* width: 30px;
           height: 30px; */
           text-align: center;
           font-size: 1rem;
       
       }
       /* .input-verify[type=number]:hover{
       
           box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.28);
       } */
       
       .input-verify {
       
           border:none;
           -webkit-border-radius:5px;
           -moz-border-radius:5px;
           border-radius:5px;
           -webkit-box-shadow:0 0 3px #666 inset;
           -moz-box-shadow:0 0 3px #666 inset;
           box-shadow:0 0 5px #666 inset;
           height:10vh;
           line-height:25px;
           width:15%;
           text-indent:5px;
       }
       .inputs-verify{
           display: flex;
           justify-content: center;
       }
       /* .input-verify[type=number]:hover {
       
           box-shadow: 0 0 5pt 0.5pt #D3D3D3;
       }
       
       .input-verify[type=number]:focus {
           box-shadow: 0 0 5pt 2pt #D3D3D3;
           outline-width: 0px;
       } */
       
       .verifybtn {
           background-color: #6259ca;
           margin: auto;
           border-radius: 5px;
           position: relative;
           z-index: 5;
           display: block;
           margin: auto;
           border: none;
           /* width: 20%; */
           padding: 10px;
           /* height: 5%; */
           color: white;
       }
       /* Chrome, Safari, Edge, Opera */
       input::-webkit-outer-spin-button,
       input::-webkit-inner-spin-button {
         -webkit-appearance: none;
         margin: 0;
       }
       
       /* Firefox */
       input[type=number] {
         -moz-appearance: textfield;
       }
       </style>
</head>
<body>
    <div class="verify-box">

        <div class="form">
            <form method="post" class="form-verify" name="verifyForm" action="{{route('otp.store')}}">
                @csrf
                <div class="verify-title">
                    لطفا کد اشتراک خود را وارد کنید
                </div>
           
                <div class="inputs-verify inputs">
                    <input id="verify-input-1" autocomplete="off" class="input-verify" type="number" name="n1"
                           maxlength="1">
                    <input id="verify-input-2" autocomplete="off" class="input-verify" type="number" name="n2"
                           maxlength="1">
                    <input id="verify-input-3" autocomplete="off" class="input-verify" type="number" name="n3"
                           maxlength="1">
                    <input id="verify-input-4" autocomplete="off" class="input-verify" type="number" name="n4"
                            maxlength="1">
                           <input id="verify-input-5" autocomplete="off"
                           class="input-verify"
                           type="number" name="n5" maxlength="1">
                           <input id="verify-input-6" autocomplete="off"
                           class="input-verify @error('n6') is-invalid @enderror"
                           type="number" name="n6" maxlength="1">

                </div>
                @error('n6')
                <p class="verifyerror" style="color:red ;text-align: center;display: block;">
                    {{$message}}
                </p>
                @enderror
                <input id="phone" type="hidden" class="form-control"
                name="id" value="{{auth()->user()->id}}">
                <button class="verifybtn" type="submit" style="text-decoration: none;" >
                    تایید حساب کاربری
                </button>
            
            </form>
        </div>


    </div>
    <script>
        //////////input verify /////////
const form = document.querySelector('[name="verifyForm"]');
const inputs = form.querySelectorAll('.inputs input');
const formData = new FormData();

function shouldSubmit() {
    console.log('shoudsubmit');
    return [...inputs].every(input => input.value.length > 0);
}


function handleInput(e) {
    // check for data that was inputted
    // if there is a next input, focus on it
    console.log('handleInput');
    const input = e.target;
    if (input.value) {
        formData.append(input.name, input.value);
        if (input.nextElementSibling) {
            input.nextElementSibling.focus();
        } else {
            document.activeElement.blur();
        }

    }
}

// function submitFocus(){
//   document.getElementById("submit").focus();
// }

function handleFocus(e) {
    console.log('handleFocus')
    if (e.target.value) {
        e.target.select();
    }
}

function handlePaste(e) {
    console.log('handlePaste')
    const paste = e.clipboardData.getData('text');
    // loop over each input and populate with the index of that string
    inputs.forEach((input, i) => {
        input.value = paste[i] || '';
        formData.set(input.name, input.value);
    });

    if (shouldSubmit()) {
        handleSubmit();
    }
}

function handleKeyDown({key, target}) {
    console.log('handleKeyDown')
    if (key !== 'Backspace') {
        return;
    } else if (target.previousElementSibling) {
        formData.delete(target.name);
        target.value = '';
        target.previousElementSibling.focus();
    }
}

// inputs[0].addEventListener('paste', handlePaste);
form.addEventListener('input', handleInput);
form.addEventListener('focusin', handleFocus);
form.addEventListener('keydown', handleKeyDown);


    </script>
</body>
</html>