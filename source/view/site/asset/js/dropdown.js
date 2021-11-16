(function(){

    function toggle(elementClass)
    {
        element = document.querySelector(`.${elementClass}`);

        if (element.classList.contains('show')) {

            element.classList.remove('show');
            return;
        }
        
        element.classList.add('show');
    }

    var button = document.querySelector('.profile_dropdown_button');

    button.addEventListener('click', () => toggle('profile_dropdown'));

})()