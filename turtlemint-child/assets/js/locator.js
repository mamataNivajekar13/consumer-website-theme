/* dropdown */
function tmSelectDropdown(element, flag) {
  $(element).siblings().removeClass("selected");
  $(element).addClass("selected");
  let iconUrl = $(element).data("icon");
  $(element)
    .parents(".tm-select-dropdown")
    .find(".tm-select-value .icon")
    .addClass(iconUrl);
  $(element)
    .parents(".tm-select-dropdown")
    .find(".tm-select-value .title")
    .text($(element).text());
    $(element)
    .parents(".tm-select-dropdown")
    .find(".tm-select-value .icon")
    .attr("alt", $(element).find('.icon').attr("alt"));
  $(element)
    .parents(".tm-select-dropdown")
    .find(".tm-select-value")
    .removeClass("placeholder");

    sessionStorage.setItem('tm_vertical_data', $(element).data('value'));
  
  if(flag){
    filterVertical()
  }
}
/* insurance type selection */
$( document ).ready(function() {

  $(".filter-select-group input[type=radio]").each(function(){
    if ($(this).is(":checked")) {
      let typeIconDefault = $(this).next('label').find('.icon').attr('icon-default');
      let typeIconColored = $(this).next('label').find('.icon').attr('icon-colored');
      //update icon
      $(this).next('label').find('.icon').removeClass(typeIconDefault);
      $(this).next('label').find('.icon').addClass(typeIconColored);
    }
  });

  $(".filter-select-group input[type=radio]").change(function () {
    // insurance type value
    sessionStorage.setItem('tm_vertical_data', $(this).val());
    
    // type icon colored
    let typeIconColored = $(this).next('label').find('.icon').attr('icon-colored');
      // remove icon
      $(this).next('label').find('.icon').removeClass(function(index, className){
        return (className.match (/(^|\s)bg-\S+/g) || []).join(' ');
      });
      //update icon
      $(this).next('label').find('.icon').addClass(typeIconColored);

      $(".filter-select-group input[type=radio]").not(this).each(function(){
       // type icon default
      let typeIconDefault = $(this).next('label').find('.icon').attr('icon-default');
      // remove icon
      $(this).next('label').find('.icon').removeClass(function(index, className){
        return (className.match (/(^|\s)bg-\S+/g) || []).join(' ');
      });
      //update icon
       $(this).next('label').find('.icon').addClass(typeIconDefault);
      });
  });
});

$(document).ready(function () {
  $(".filter-select-group input[type=radio]").change(function () {
    gtag("event", "Btn_click-" + $(this).data("value"), {
      event_category: "DP_Intro-Buttons",
      event_label: $(this).data("value"),
    });
  });
});

$(".tm-select-value").click(function () {
  $(this).next(".tm-select-options").slideToggle();
});
$(".tm-select-option").click(function () {
  $(this).parent(".tm-select-options").slideUp();
});

/* Skeletons */
// $(document).ready(function(){
//     setTimeout(function(){
//         $('.tm-loading').removeClass('tm-loading');
//     }, 2000);
// });

/* popup */
function openPopup(popupId, advisorName, advisorId) {
  $("#" + popupId).addClass("show");
  $('body').addClass('tmStopScorll')

  if(popupId == 'tmOtpPopup'){
    countDownTimer(0, 0, 30);
  }
  if(advisorName){
    window.tm_advisor_name = advisorName;
  }
  if(advisorId){
    window.tm_advisor_id = advisorId;
  }

  switch(popupId){
    case "pincodePopup": 
      gtag('event', 'Popup-'+sessionStorage.getItem('tm_vertical_data'), {
        'event_category': 'DPL_Popup',
        'event_label': 'Pincode_Popup'
      });
      break;

    case "getInTouchPopup":
      gtag('event', 'GIT-Btn_click-'+sessionStorage.getItem('tm_vertical_data')+'-Get-In-Touch', {
        'event_category': 'DPL_Buttons',
        'event_label': 'GIT-' + window.tm_advisor_name + '-' + JSON.parse(sessionStorage.getItem('tm_pincode_data')).pinCode
      });
      break;
    
    default:
      break;
      
  }

}
function closePopup(popupId) {
  if(!$("#" + popupId).hasClass('restrict-event')){
    $("#" + popupId).removeClass("show disableCloseBtn");
    $('body').removeClass('tmStopScorll')
  }
  if(popupId == 'tmOtpPopup'){
    clearOTP()
      $('#tmOtpForm').find('.resend-text').text('Resend code in')
      $('#tmOtpForm').find('.timer').text('')
      clearInterval(counter);
  }
  if(popupId=="getInTouchPopup"){
    $('#maxLimitMsg').removeClass('d-block')
  }
}

window.addEventListener("DOMContentLoaded", (event) => {
  $(".tm-popup").click(function (e) {
    if (e.target == this) {
      closePopup($(this).attr("id"));
    }
  });
});

function populateVertical(){
/*   let selectedVertical = $('.tm-select-dropdown:not(.skeleton-dropdown)').find('.tm-select-options .tm-select-option.selected');
  let defaultVertical = $('.tm-select-dropdown:not(.skeleton-dropdown) .tm-select-value'); */
  //console.log("value : ", $(selectedVertical).data('value'));
  /* $(defaultVertical).html($(selectedVertical).html()); */
  //imp
  // $('.tm-select-dropdown:not(.skeleton-dropdown)').find('.tm-select-options .tm-select-option[data-value='+ window.tm_vertical_data +']').click();

  $('.tm-select-dropdown:not(.skeleton-dropdown)').find('.tm-select-options .tm-select-option[data-value='+ sessionStorage.getItem('tm_vertical_data') +']').each(function(index, element){
    // console.log(element)
    $(element).siblings().removeClass("selected");
    $(element).addClass("selected");
    let iconUrl = $(element).data("icon");
    $(element)
    .parents(".tm-select-dropdown")
    .find(".tm-select-value .icon")
    .removeClass(function(index, className){
      return (className.match (/(^|\s)bg-\S+/g) || []).join(' ');
    });
    $(element)
      .parents(".tm-select-dropdown")
      .find(".tm-select-value .icon")
      .addClass(iconUrl);
    $(element)
      .parents(".tm-select-dropdown")
      .find(".tm-select-value .title")
      .text($(element).text());
    $(element)
    .parents(".tm-select-dropdown")
    .find(".tm-select-value .icon")
    .attr("alt", $(element).find('.icon').attr("alt"));
  })

/*   $(".filter-select-group input[type=radio][value="+ window.tm_vertical_data +"]").prop("checked", true);
  let coloredIcon = $(".filter-select-group input[type=radio][value="+ window.tm_vertical_data +"]").next('label').find('.icon');
  $(coloredIcon).attr('id', $(coloredIcon).attr('icon-colored')); */
}

/* pincode form */
const inputs = document.querySelectorAll('.single-input-group input');
inputs[0] ? inputs[0].focus() : '';
for (elem of inputs) {
  elem.addEventListener('input', function() {
    const value = this.value;
    const nextElement = this.nextElementSibling;
    if (value === '' || !nextElement) {
      return;
    }
    nextElement.focus();
  });
}
for (let elem of inputs) {
  elem.addEventListener('keydown', function(event) {
     //Right Arrow Key
    if (event.keyCode == 39) {
      this.nextElementSibling.focus();
    }
     //Left Arrow Key
    //Add Highlight
    if (event.keyCode == 37) {
      this.previousElementSibling.focus();
    }
    //Backspace Key
    if (event.keyCode == 8 && event.metaKey) {
      for (innerElem of inputs) {
        innerElem.value = '';
      }
      inputs[0].focus();
    } else if (event.keyCode == 8) {
      if(elem.value === '') {
        this.previousElementSibling.focus();
        return;
      }
      elem.value = '';
    }
  });
}
$(document).on('change keyup', '.required', function(e){
  let parent = $(e.target).parents('.tm-popup');

    let Disabled = true;
     $(parent).find(".required").each(function() {
       let value = this.value
       if ((value)&&(value.trim() !=''))// && $(parent).find('.tm-form-group.tm-error').length < 1)
           {
             Disabled = false
           }else{
             Disabled = true
             return false
           }
     });

    if(Disabled){
        $(parent).find('.tm-button').prop("disabled", true);
        if($(parent).attr('id') == 'pincodePopup'){
         // $('#pincodeForm .location-name:not(.location-name-skeleton), #pincodeForm .error-message').removeClass('d-block').addClass('d-none')
          $('#pincodeForm .error-message').removeClass('d-block')
          $('#pincodeForm .tm-form-group').removeClass('tm-error');
        }
        if($(parent).attr('id') == 'tmOtpPopup'){
          //$('#tmOtpForm .location-name:not(.location-name-skeleton), #tmOtpForm .error-message').removeClass('d-block').addClass('d-none')
          $('#tmOtpForm .error-message').removeClass('d-block')
          $('#tmOtpForm .tm-form-group').removeClass('tm-error');
        }
    }
    else{
        // console.log($(parent).attr('id'))
        if($(parent).attr('id') == 'pincodePopup'){
            pincodeValidaion()
        }
        else{
            $(parent).find('.tm-button').prop("disabled", false);
            if($(parent).find('.tm-form-group.tm-error').length > 0){
              $(parent).find('.tm-button').prop("disabled", true);
            }
        }
    }

  })

/* otp timer */
function countDownTimer(hours, minutes, seconds){

const oneSec = 1000,
container = document.getElementById('countdowntimer');

let dataHours 	= hours,
dataMinutes = minutes,
dataSeconds = seconds

if (dataHours == '' || dataHours == null || dataHours == NaN) {
dataHours = "0";
}
if (dataMinutes == '' || dataMinutes == null || dataMinutes == NaN) {
dataMinutes = "0";
}
if (dataSeconds == '' || dataSeconds == null || dataSeconds == NaN) {
dataSeconds = "0";
}

let hoursSpan = document.createElement('span'),
minutesSpan = document.createElement('span'),
secondsSpan = document.createElement('span'),
separator1 = document.createElement('span'),
separator2 = document.createElement('span'),
separatorValue = ":",
max = 59,
s = parseInt(dataSeconds) > max ? max : parseInt(dataSeconds),
m = parseInt(dataMinutes) > max ? max : parseInt(dataMinutes),
h = parseInt(dataHours);

secondsSpan.classList.add('time');
minutesSpan.classList.add('time');
hoursSpan.classList.add('time');
separator1.classList.add('separator');
separator1.textContent = separatorValue;
separator2.classList.add('separator');
separator2.textContent = separatorValue;

checkValue = (value)=>{
if (value < 10) {
return "0" + value;
} else {
return value;
}
}

hoursSpan.textContent = checkValue(dataHours);
minutesSpan.textContent = checkValue(dataMinutes);
secondsSpan.textContent = checkValue(dataSeconds);

timer = (sv,mv,hv)=>{

s = parseInt(sv);
m = parseInt(mv);
h = parseInt(hv);

if (s > 0) {
return s -= 1;
} else {
s = max;
if (m > 0) {
  return m -= 1;
} else {
  m = max;
  if (h > 0) {
    return h -= 1;
  }
}
}
}

finished = ()=>{
max = 0;
$(container).parent('.resend-timer').addClass('success');
$(container).parent('.resend-timer').attr('onclick', 'resendCode(this)');
$(container).parent('.resend-timer').find('.resend-text').text('Resend code');
$(container).parent('.resend-timer').find('.timer').text('');
}

counter = setInterval(()=>{

if (h == 0 && m == 0 && s == 1) {
clearInterval(counter, finished());
}

if (s >= 0) {
timer(s,m,h);
hoursSpan.textContent   = checkValue(h);
minutesSpan.textContent = checkValue(m);
secondsSpan.textContent = checkValue(s);
}
}, oneSec);

let children = [minutesSpan, separator2, secondsSpan];

for (child of children) {
container.appendChild(child);
}
}

async function resendCode(element){
  try{
    $(element).addClass('tm-loader-dark')
    let response = await fetch(SERVER_2+'/api/commonverticals/v1/otp/resend?broker=turtlemint&source=Consumer&sessionId='+sessionStorage.getItem('tm_user_session_id'), {
        'method' : 'GET',
        'headers': {
          'Content-Type': 'application/json',
          "APIkey": API_KEY
        }
    });
    let data = await response.json()
    $(element).find('.resend-text').text('Code resent successfully. Send again?');
    $(element).attr('onclick', '');
    $(element).removeClass('success');
    clearOTP()
    countDownTimer(0, 0, 30);
  }
  catch(err){
    console.log("Resend code error: ",err)
    $(element).find('.resend-text').text('Error in sending code. Please try again later.');
    $(element).removeClass('success');
  }
  finally{
    $(element).removeClass('tm-loader-dark')
  }
}
async function pincodeValidaion(){
    let pincode = ''
    $('#pincodeForm .location-wraper').addClass('tm-loading')
    $('#pincodeForm .required').each(function(){
        pincode += $(this).val()
    })
    let pincodeData = await getPincodeLocation(pincode);
    // console.log('pinDara', pincodeData)
    if(pincodeData.error){
        $('#pincodeForm .error-message').text(pincodeData.info).addClass('d-block').removeClass('d-none')
        $('#pincodeForm .tm-form-group').addClass('tm-error');
    }
    else{
        //$('#pincodeForm .location-name:not(.location-name-skeleton)').text(pincodeData.area+', '+pincodeData.city+', '+pincodeData.state).removeClass('d-none')
        $('#pincodeForm .tm-button').prop("disabled", false);
    }
    $('#pincodeForm .location-wraper').removeClass('tm-loading')
}
function tmScrollToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
$('#pincodeForm').submit( function(e){
    e.preventDefault();
    $('#pincodePopup').removeClass('restrict-event')
    $(this).find('.tm-button').addClass('tm-loader')
    // console.log('test',window.tm_pincode_data)
    // let vertical = $(this).find('.tm-select-value.selected').data('value')
    let vertical = $(this).find('input[name=tm-insurance-type]:checked').val()
    $('.tm-select-option[data-value='+vertical+']').addClass('selected')
    getAdvisorList(JSON.parse(sessionStorage.getItem('tm_pincode_data')).pinCode,vertical)

    gtag('event', 'Btn_click-'+sessionStorage.getItem('tm_vertical_data')+'-Submit', {
      'event_category': 'DPL_Popup',
      'event_label': 'Submit-'+ JSON.parse(sessionStorage.getItem('tm_pincode_data')).pinCode
    });
    tmScrollToTop()
})

/******* get in touch Form flow ********/
//forms
let getInTouchForm = document.getElementById('getInTouchForm');

//patterns
let phonePattern = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4}$/im;

//Error Messages
let phoneinvalidMessage = "Please enter a valid mobile number";

// phone validation
function phoneValidation(input) {
  let formElement = $(input).parents('.tm-form')
  let parentGroup = $(input).parents('.tm-form-group')
  if (input.value.match(phonePattern)) {
    $(parentGroup).removeClass('tm-error')
    $(parentGroup).find('.error-message').text('').slideUp()
  }else{
    $(parentGroup).addClass('tm-error')
    $(parentGroup).find('.error-message').text(phoneinvalidMessage).slideDown()
  }
}

// phone
$(document).on('change keyup', '#tm-mobileNo', function(e){
    phoneValidation(this);

    let form = $(this).parents('.tm-form');
    let formErrors = $(form).find('.tm-form-group.tm-error').length
    // console.log("Errors: ", formErrors);
    if(formErrors > 0 || $(form).find('.required').val()===''){
      // console.log('has Errors');
      $(form).find('.tm-button').prop("disabled", true);
    }
    else{
      // console.log('No Errors');
      (form).find('.tm-button').prop("disabled", false);
    }
    
});

// contact form
// $(getInTouchForm).submit(function( e ){
//   e.preventDefault();
//   $(this).find('.tm-button').addClass('tm-loader')
// })

$('#getInTouchForm').submit( async function(e){
  e.preventDefault();
  $(this).find('.tm-button').addClass('tm-loader')
  const name = $(this).find('#tm-name').val()
  const phone = $(this).find('#tm-mobileNo').val()

  /* Lead Details Tracking | Start */
  //google sheet form submition

  /* jQuery.ajax({
    url : '../wp-content/themes/turtlemint/tm-google-sheet/leads-sheet.php',
    type: 'post',
    dataType: 'json',
    data: {
      'consumer_name': name,
      'consumer_phone': phone
    },
    success: function(obj){
      console.log("Success!")
      console.log(obj.result)
    }
  }); */

  /* Lead Details Tracking | End */

    /* Lead Details Tracking | Start */
    gtag('event', sessionStorage.getItem('tm_vertical_data') + '-'+ window.tm_advisor_name, {
      'event_category': 'DPL_Lead_Details',
      'event_label': name + '-' + phone
    });
    /* Lead Details Tracking | End */

  try{
    let response = await fetch(SERVER_2+'/api/commonverticals/v1/otp/send?mobile='+phone+'&broker=turtlemint&source=Consumer', {
      'method' : 'GET',
      'headers': {
        'Content-Type': 'application/json',
        "APIkey": API_KEY
      }
    });
    let data = await response.json()
    if(data && data.status_code == 200){
      sessionStorage.setItem('tm_user_name', name)
      sessionStorage.setItem('tm_user_phone', phone)
      sessionStorage.setItem('tm_user_session_id', data.session_id)
      $('#otpPhone').text('+91 '+phone)
      $('#maxLimitMsg').removeClass('d-block')
      $(this).find('.tm-button').removeClass('tm-loader')
      closePopup("getInTouchPopup")
      openPopup("tmOtpPopup");
      gtag('event', 'LF-Btn_click-'+sessionStorage.getItem('tm_vertical_data')+'-Submit', {
        'event_category': 'DPL_Buttons',
        'event_label': 'LF-'+window.tm_advisor_name
      });
    }
    else{
      throw 'No Servere Response'
    }
  }
  catch(err){
    console.log("Error in submiting the details: ", err)
    $('#maxLimitMsg').addClass('d-block');
    $(this).find('.tm-button').removeClass('tm-loader')

    //TODO remove 4 lines
    //  $('#otpPhone').text('+91 '+phone)
    //  $(this).find('.tm-button').removeClass('tm-loader')
    //  closePopup("getInTouchPopup")
    //  openPopup("tmOtpPopup");
  }
})

$('#tmOtpForm').submit( async function(e){
  e.preventDefault();
  $(this).find('.tm-button').addClass('tm-loader')
  let otp =  ''
  $(this).find('.required').each(function(){
    otp += $(this).val()
  })
  try{
    let response = await fetch(SERVER_2+'/api/commonverticals/v1/otp/verify?&broker=turtlemint&source=Consumer', {
      'method' : 'POST',
      'headers': {
      'Content-Type': 'application/json',
      "APIkey": API_KEY
      },
      'body': JSON.stringify({
        "sessionId":sessionStorage.getItem('tm_user_session_id'),
        "otp": otp
      })
    })
    let data = await response.json()
    if(data.statusCode && data.statusCode === 200){
      gtag('event', 'OTP-Btn_click-'+sessionStorage.getItem('tm_vertical_data')+'-Submit', {
        'event_category': 'DPL_Buttons',
        'event_label': 'OTP-'+window.tm_advisor_name
      });
      //save data       
      let save_data_response = await fetch(SERVER+"/api/agent-locator/consumer-lead-gen/webhook/"+window.tm_advisor_id+"?vertical="+sessionStorage.getItem('tm_vertical_data'), { 
        method: "POST",
        body: JSON.stringify({
          "email": null,
          "name": sessionStorage.getItem('tm_user_name'),
          "phone": sessionStorage.getItem('tm_user_phone'),
          "url": SERVER+"/leadforms?partnerId="+window.tm_advisor_id
        }),
        headers: {
        "broker": "turtlemint",
        "Content-Type": "application/json",
        "APIkey": API_KEY
        }
      });
      let save_data = await save_data_response.json();
      console.log(save_data);
      clearOTP()
      $('#tmOtpForm').find('.resend-text').text('Resend code in')
      $('#tmOtpForm').find('.timer').text('')
      // $('#tmOtpForm').find('.resend-timer').removeClass('success')
      // $('#tmOtpForm').find('.error-message').addClass('d-none').removeClass('d-block')
      // $('#tmOtpForm').find('.tm-form-group').removeClass('tm-error')
      clearInterval(counter);
      $('#tm_advisor_name').text(window.tm_advisor_name)
      closePopup("tmOtpPopup")
      openPopup("tmSuccessPopup");
      gtag('event', 'Lead_submitted_successfull', {
        'event_category': 'DPL_Leads',
        'event_label': sessionStorage.getItem('tm_vertical_data')+'-'+window.tm_advisor_name
      });
    }
    else if (data.statusCode){
      throw data.message;
    }
    else{
      throw "OTP verification error. Please try again, or resend OTP";
    }
  }
  catch(err){
    console.log("Error in submitting otp: ", err)
    $('#tmOtpForm .error-message').text(err).addClass('d-block')
    $('#tmOtpForm .tm-form-group').addClass('tm-error');
  }
  finally{
    $(this).find('.tm-button').removeClass('tm-loader')
    //TODO remove 10 lines
    // clearOTP()
    // $('#tmOtpForm').find('.resend-text').text('Resend code in')
    // $('#tmOtpForm').find('.timer').text('')
    // // $('#tmOtpForm').find('.resend-timer').removeClass('success')
    // // $('#tmOtpForm').find('.error-message').addClass('d-none').removeClass('d-block')
    // // $('#tmOtpForm').find('.tm-form-group').removeClass('tm-error')
    // clearInterval(counter);
    // $('#tm_advisor_name').text(window.tm_advisor_name)
    // closePopup("tmOtpPopup")
    // openPopup("tmSuccessPopup");
  }
})

/* testimonial slider */
$('.tm-testimonial-slider').slick({
  arrows:false,
  dots: true
});

function clearOTP(){
  $('#tmOtpForm input.required').val('').change()
}

/* advisor intro page - find advisor form */
let findAdvisorError = "Please select type of insurance to proceed to the next step"
$('#tmFindAdvisorForm').submit( function(e){
  e.preventDefault();
  let vertical = $(this).find('.filter-select-group input[type=radio]:checked').val();
  if(vertical){
    /* success */
    let selectedInsurance = $(this).find('.filter-select-group input[type=radio]:checked').data('value')
    $(this).find('.filter-form-group').removeClass('tm-error')
    $(this).find('.filter-form-group .error-message').slideUp()
    $(this).find('.filter-form-group .error-message').text('')
    // $(this).find('.tm-button').addClass('tm-loader')

    gtag('event', 'Btn_click-'+selectedInsurance+'-Find_Advisor', {
      'event_category': 'DP_Intro-Buttons',
      'event_label': 'Find Advisor'
    });

    $(this).unbind().submit()
  }else{
    /* failed */
    $(this).find('.filter-form-group').addClass('tm-error')
    $(this).find('.filter-form-group .error-message').text(findAdvisorError)
    $(this).find('.filter-form-group .error-message').slideDown()

    gtag('event', 'DP_Intro-Message-Not_selected', {
      'event_category': 'DP_Intro_Error',
      'event_label': findAdvisorError
    });
  }
})