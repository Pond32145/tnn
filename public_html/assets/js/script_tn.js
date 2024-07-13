const btnLabTest = document.querySelectorAll('.tabs_link');
const headerMain = document.querySelectorAll('.header-bg.main');
const btnBack = document.querySelectorAll('.tb01.text-span-4');

btnLabTest.forEach((e) =>{
  e.addEventListener('click',() =>{
    headerMain.forEach((element)=>{
        element.style.display = 'none';
    })
  })

});

btnBack.forEach((element)=>{
    element.addEventListener('click', (e) =>{
        headerMain.forEach((hid) => {
            hid.style.display = 'flex';
        });
    });
});

const box_grid = document.querySelectorAll('.box_grid_product');
const overflowBtn = document.querySelectorAll('.txt_more');
let statusOverflow = true;
    overflowBtn.forEach((e)=>{
        e.addEventListener('click', ()=>{
            if(statusOverflow){
            box_grid.forEach((ele)=>{
                ele.style.overflow = 'auto';
            })
            statusOverflow = false;
        }else{
            box_grid.forEach((ele)=>{
                ele.style.overflow = '';
            })
            statusOverflow = true;
        }
        })
    })
    document.addEventListener("DOMContentLoaded", function() {
       
        var dropdownToggle = document.getElementById("w-dropdown-toggle-0");
        var dropdownList = document.getElementById("w-dropdown-list-0");
        dropdownToggle.addEventListener("mouseover", function() {
          dropdownToggle.classList.add("w--open");
          dropdownList.classList.add("w--open");
        });
        dropdownList.addEventListener("mouseleave", function() {
          dropdownToggle.classList.remove("w--open");
          dropdownList.classList.remove("w--open");
        });
      });