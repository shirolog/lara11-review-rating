(() => {
    //headerメニュー設定
    const $profile = document.querySelector('.header .flex .profile');
    const $user = document.querySelector('#user-btn');

    $user.addEventListener('click', function(e){

        e.preventDefault();

        $profile.classList.toggle('active');
    });

    window.addEventListener('scroll', function(){

        $profile.classList.remove('active');
    });


    const $number = document.querySelectorAll('input[type="number"]');

    $number.forEach(inputNumber => {
      
        inputNumber.oninput = () => {
            const maxLength = inputNumber.getAttribute('maxlength'); // maxlength 属性を取得
            if (maxLength && inputNumber.value.length > maxLength) {
                // 入力値を maxlength に制限
                inputNumber.value = inputNumber.value.slice(0, maxLength);
            }
        };
    });
})();
