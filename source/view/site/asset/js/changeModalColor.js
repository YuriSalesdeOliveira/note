(() => {

    function changeModalColor(modalContainerClass, changeColorFromClass, colorsContainerClass)
    {
       function findColors()
       {
            let modalContainer =  document.querySelector(`.${modalContainerClass}`);

            let form = modalContainer.querySelector('form');

            let colorsContainer = form.querySelector(`.${colorsContainerClass}`);

            let colorsOptions = colorsContainer.querySelectorAll('input[type="radio"]');

            return colorsOptions;
       }

       colorsOptions = findColors();

       function changeColor(color, backgroundColor, changeColorFrom)
       {
            changeColorFrom.style.color = color;
            changeColorFrom.style.backgroundColor = backgroundColor;
       }

       colorsOptions.forEach(element => {

            if (element.checked) {

               let backgroundColor = element.dataset.color_background_color;
               let color = element.dataset.color_color;

               let changeColorFrom = document.querySelector(`.${changeColorFromClass}`);

               changeColor(color, backgroundColor, changeColorFrom);
          }

       });

    }

    setInterval(() => {
          changeModalColor('modal_container', 'modal_add_note', 'color_note')
    }, 100);

})();