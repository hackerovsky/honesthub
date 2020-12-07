import $ from 'jquery';
// import Swiper from 'swiper';
import Swiper from '../../node_modules/swiper/dist/js/swiper.min.js'
import modal from 'jquery-modal';
import MagnificPopup from 'magnific-popup';
import barba from '@barba/core';
import gsap from 'gsap';


$(document).ready(function () {

  barba.init({
    
    transitions: [{
      name: 'opacity-transition',
      sync: true, 
      leave(data) {
        return gsap.to(data.current.container, {
          opacity: 0.1,
          duration: 1
            
        });
      },
      enter(data) {
        return gsap.from(data.next.container, {
          opacity: 0.1,
          duration: 1
        });
      }
    }]
  });

  // Nav line
  const target = document.querySelector(".js-nav-item-line");
  const links = document.querySelectorAll(".js-nav-item");
  const list = document.querySelector(".js-nav-list");
  const colors = ['#266EC2'];
  
  for (let i = 0; i < links.length; i++) {
    // links[i].addEventListener("click", (e) => e.preventDefault());
    links[i].addEventListener("mouseenter", mouseenterFunc);
    list.addEventListener("mouseleave", initTargetSet);
  }

  function mouseenterFunc() {
    if (!this.parentNode.classList.contains("is-active")) {
      for (let i = 0; i < links.length; i++) {
      if (links[i].parentNode.classList.contains("is-active")) {
        links[i].parentNode.classList.remove("is-active");
        }
        links[i].style.opacity = ".85";
      }
     
      this.parentNode.classList.add("is-active");
      this.style.opacity = "1";
     
      const width = this.getBoundingClientRect().width;
      const height = this.getBoundingClientRect().height;
      const left = this.offsetLeft + window.pageXOffset;
      const top = this.getBoundingClientRect().top + window.pageYOffset - 2;
      const color = colors[Math.floor(Math.random() * colors.length)];
     
      target.style.width = `${width}px`;
      target.style.height = `2px`;
      // target.style.height = `${height}px`;
      target.style.left = `${left}px`;
      target.style.top = `${top}px`;
      target.style.borderColor = color;
      target.style.transform = "none";
    }
  }

  window.addEventListener("resize", resizeFunc);

  function resizeFunc() {
    const active = document.querySelector(".js-nav-item.is-active");
   
    if (active) {
      const left = this.offsetLeft + window.pageXOffset;
      const top = active.getBoundingClientRect().top + window.pageYOffset - 2;
      
      target.style.left = `${left}px`;
      target.style.top = `${top}px`;
    }
  }

  function initTargetSet() {
    const active = document.querySelector(".js-nav-item.is-active");
    const width = active.getBoundingClientRect().width;
    const height = active.getBoundingClientRect().height;
    const left = active.offsetLeft + window.pageXOffset;
    const top = active.getBoundingClientRect().top + window.pageYOffset - 2;
    const color = colors[Math.floor(Math.random() * colors.length)];

    for (let i = 0; i < links.length; i++) {
      if (links[i].parentNode.classList.contains("is-active")) {
        links[i].parentNode.classList.remove("is-active");
        }
        links[i].style.opacity = "1";
      }
   
    active.classList.add("is-active");
    target.style.width = `${width}px`;
    target.style.height = `2px`;
    // target.style.height = `${height}px`;
    target.style.left = `${left}px`;
    target.style.top = `${top}px`;
    target.style.borderColor = color;
    target.style.transform = "none";
  }

  if ($('header').length > 0) {
    initTargetSet();
  }

  // Profile Info

  $('.js-profile-info-showmore').click(function() {
    if ($(this).attr('data-state') == 'hidden') {
      
      $(this).html('Показать меньше')
      $(this).attr('data-state', 'shown');
      $(this).closest('.js-profile-info-list').find('.js-profile-info-item.is-hidden').removeClass('is-hidden').addClass('is-shown');
    } else if ($(this).attr('data-state') == 'shown') {
      
      $(this).html('Показать больше')
      $(this).attr('data-state', 'hidden');
      $(this).closest('.js-profile-info-list').find('.js-profile-info-item.is-shown').removeClass('is-shown').addClass('is-hidden');
    }
    
  });

  $('.js-menu-btn').click(function() {
    $(this).toggleClass('is-active');
    $('.js-menu').toggleClass('is-opened');
  });

  $('.js-search-btn').click(function() {
    $('.js-search-field').toggleClass('is-active');
  });

  $('.js-appointment-bar-btn').click(function() {
    if ($('.js-profile-bar').hasClass('is-active')) {
      $('.js-profile-bar').removeClass('is-active')
      $('.js-profile-bar').css({top: -240})
    }
    var isActive = $('.js-appointment-bar').hasClass('is-active');
    isActive == true ? $('.js-appointment-bar').css({top: -240}) : $('.js-appointment-bar').css({top: $(this).offset().top + 45, left: $(this).offset().left - 335});
    isActive == true ? $('.js-appointment-bar').removeClass('is-active') : $('.js-appointment-bar').addClass('is-active');
  });

  $('.js-profile-btn').click(function() {
    if ($('.js-appointment-bar').hasClass('is-active')) {
      $('.js-appointment-bar').css({top: -240})
      $('.js-appointment-bar').removeClass('is-active')
    }
    $('.js-profile-btn').toggleClass('is-active')
    var isActive = $('.js-profile-bar').hasClass('is-active');
    console.log(isActive)
    isActive == true ? $('.js-profile-bar').css({top: -240}) : $('.js-profile-bar').css({top: $(this).offset().top + 53, left: $('.js-profile-chevron').offset().left - 260});
    isActive == true ? $('.js-profile-bar').removeClass('is-active') : $('.js-profile-bar').addClass('is-active');
  });


});