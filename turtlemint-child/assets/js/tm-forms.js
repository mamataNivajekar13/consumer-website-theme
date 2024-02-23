var app_base_url = location.protocol + '//app.turtlemint.com';

/*Cookie Ashish TM 20211227 */
function setCookie(cname, cvalue, domain, exdays) { var d = new Date(); if (!exdays) { exdays = 1; } d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000)); var expires = "expires=" + d.toUTCString(); document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;Domain=" + domain;}

    /*UTM Manoj 20211227 */
    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    window.onload = function() {var utm_source = getUrlVars()["utm_source"]; var utm_medium = getUrlVars()["utm_medium"]; var utm_campaign = getUrlVars()["utm_campaign"]; var referrer = getUrlVars()["referrer"]; var gclid = getUrlVars()["gclid"]; /*alert(""+author+"Enter your js here!"+a1+"");*/ };

function addparams(myurl)
{
    /*var utm_source = getUrlVars()["utm_source"]; var utm_medium = getUrlVars()["utm_medium"]; var utm_campaign = getUrlVars()["utm_campaign"]; var referrer = getUrlVars()["referrer"]; var gclid = getUrlVars()["gclid"]; 
    var regNumber = $('input[name="regNumber"]').val().toUpperCase();
    var newhref=url+'?utm_source='+utm_source+'&utm_medium='+utm_medium+'&utm_campaign='+utm_campaign+'&referrer='+referrer+'&gclid='+gclid+'&regNumber='+regNumber;
    window.location.href = newhref;*/        
    var regNumber = $('input[name="regNumber"]').val().toUpperCase();
    //console.log("regNumber: "+regNumber)
    var oldhref = myurl;
    //console.log("oldhref: "+oldhref)
    oldhref = oldhref.replace("%3F", "?");
    oldhref = oldhref.replace("%3D", "&");
    //console.log("oldhref: "+oldhref)
    var utmparams = location.search;
    //console.log("utmparams: "+utmparams)
    if(oldhref.indexOf("?") > -1) { /*Yes, so replace*/ utmparams = utmparams.replace("?", "&");  }    
    /*var newhref=obj.getAttribute("href")+location.search;*/
    if(utmparams == ""){
        var newhref = oldhref+utmparams+'?regNumber='+regNumber;
        //console.log("newhref: "+newhref)
    }
    else{
        var newhref = oldhref+utmparams+'&regNumber='+regNumber;
    }
    newhref = newhref.replace("%3F", "?");
    newhref = newhref.replace("%3D", "&");
    //console.log("newhref: "+newhref)
    window.location.href = newhref;
}

// Select Insurance Radio Buttons
function checkSteps(element){
    if(element.checked){
        $(element).parents('.step').find('.tm-message').slideUp()
        setTimeout(function(){
            $(element).parents('.step').find('.tm-message').removeClass('tm-error')
        }, 1000)
        $(element).next('.radio-button').addClass('tm-sprite-3-before bg-checkmark-green')
        $(element).parents('.tm-radio-vertical').addClass('checked')
        $("#tm-select-insurance").find(".tm-radio-vertical input[type='radio']").not(element).next('.radio-button').removeClass('tm-sprite-3-before bg-checkmark-green')
        $("#tm-select-insurance").find(".tm-radio-vertical input[type='radio']").not(element).parents('.tm-radio-vertical').removeClass('checked')

        $(element).parents('.step').removeClass('current')
        $(element).parents('.step').addClass('complete').find('.step__head .step-number').addClass('tm-sprite-3-before bg-checkmark-green')
        $(element).parents('.step').next('.step').addClass('current')

		// button animation
		let ctaButtons = $(element).parents('.step').next('.step').find('.tm-button');
		if($(ctaButtons).hasClass('button-pulse')){
			$(ctaButtons).removeClass('button-pulse');
			setTimeout(function() {
				$(ctaButtons).addClass('button-pulse');
			}, 1000);
		}else{
			$(ctaButtons).addClass('button-pulse');
		}

        if($(element).parents('.step').hasClass('error')){
            $(element).parents('.step').removeClass('error')
        }
    }
}
let checkedVerticalRadioButton = $('input[name=vertical]:checked', '.tm-radio-verticals');
if(checkedVerticalRadioButton[0]){
    checkSteps(checkedVerticalRadioButton[0]);
}
$(".tm-radio-vertical input[type='radio']").change(function(){
    checkSteps(this);
});
function appVerticalRedirection(vertical, regNumber){
    if(regNumber){
        switch (vertical) {
            case ('FW'):
                //window.location.href = app_base_url + '/car-insurance/car-profile';                
                addparams(app_base_url + '/car-insurance/car-profile');
                break;
            case ('TW'):
                //window.location.href = app_base_url + '/two-wheeler-insurance/two-wheeler-profile';
                addparams(app_base_url + '/two-wheeler-insurance/two-wheeler-profile');
                break;
            case ('CV'):
                //window.location.href = '/two-wheeler-insurance/two-wheeler-profile';
                addparams(app_base_url + '/two-wheeler-insurance/two-wheeler-profile');
                break;
            default: ;
        }
    }else{
        switch (vertical) {
            case ('FW'):
                window.location.href = app_base_url + '/car-insurance/car-profile';
                break;
            case ('TW'):
                window.location.href = app_base_url + '/two-wheeler-insurance/two-wheeler-profile';
                break;
            case ('CV'):
                window.location.href = '/two-wheeler-insurance/two-wheeler-profile';
                break;
            case ('Health'):
                window.location.href = app_base_url + '/health-insurance/health-profile/profile-gender';
                break;
            case ('Life'):
                window.location.href = app_base_url + '/life-insurance/profile/term/about-insured';
                break;
            default:;
        }
    }
}
function verticalRedirect(target, element, vertical){
    let checkedVertical;
    let buttonName = $(element).text();
    if(!($(element).parents('.step').hasClass('current'))){
      $(element).parents('.step').prev('.step').addClass('error')
      $(element).parents('.step').prev('.step').find('.tm-message').addClass('tm-error').text('Please select type of insurance to proceed to the next step').slideDown()
      gtag("event", "HP-Message-Not_selected", {
        event_category: "HP-Error",
        event_label: "Please select type of insurance to proceed to the next step",
      });
    }else{
        checkedVertical = $(element).parents('.step').prev('.step').find('.tm-radio-vertical.checked input[type=radio]').val()
        //console.log(checkedVertical)
    }

    if(target == 'redirect'){

        if(checkedVertical && buttonName){
            gtag("event", "Btn_click-"+checkedVertical+"-"+buttonName, {
                event_category: "HP-Buttons",
                event_label: buttonName,
            });
        }
            
        let redirectURl = '#'

        if(checkedVertical != ''){
            switch(checkedVertical){
                case 'Health':
                    redirectURl = 'https://app.turtlemint.com/health-insurance/health-profile/profile-gender'
                    break;
                case 'Life':
                    redirectURl = base_url+'/life-insurance/'
                    break;
                case 'TW':
                    redirectURl = 'https://app.turtlemint.com/two-wheeler-insurance/two-wheeler-profile/tw-registration-info'
                    break;
                case 'FW':
                    redirectURl = 'https://app.turtlemint.com/car-insurance/car-profile/car-registration-info'
                    break;
            }
        }

        if (vertical){
            gtag('event', 'Btn_click-'+buttonName, {
                'event_category': vertical+'_VP-Buttons',
                'event_label': buttonName
            });
            appVerticalRedirection(vertical)
        }

        window.location.href = redirectURl
    }

    else if(vertical && target != 'redirect'){
        gtag('event', 'Btn_click-'+buttonName, {
            'event_category': vertical+'_VP-Buttons',
            'event_label': buttonName
        });
        let redirectURl = base_url+'/insurance-advisor-near-me/?vertical='+vertical;
        window.location.href = redirectURl;
    }

    else if(target == 'findAdvisor' && !vertical && checkedVertical){
        gtag("event", "Btn_click-"+checkedVertical+"-"+buttonName, {
            event_category: "HP-Buttons",
            event_label: buttonName,
        });
        $( "#tm-select-insurance" ).submit();
    }

    else{

    }
}

function getVertical(){
    let vertical = '';
    if (location.pathname.indexOf('car') > -1) {
        vertical = 'FW';
    } else if (location.pathname.indexOf('two-wheeler-insurance') > -1) {
        vertical = 'TW';
    }else if (location.pathname.indexOf('bike-insurance') > -1) {
        vertical = 'TW';
    } else if (location.pathname.indexOf('commercial-vehicle') > -1) {
        vertical = 'CV';
    } else if (location.pathname.indexOf('health-insurance') > -1) {
        vertical = 'Health';
    } else if (location.pathname.indexOf('life-insurance') > -1) {
        vertical = 'Life';
    }
    return vertical;
};

function isValidRegNo(regNumber) {
    return /^[A-Za-z]{2}[-]?[0-9]{1,2}[-]?([A-Za-z]{0,3})[-]?[0-9]{4}$/.test(regNumber);
}

var setItemSession = function (vertical, item, value) {
    var lsMap = window.sessionStorage.getItem(vertical);
    var objMap = (lsMap) ? JSON.parse(lsMap) : {};
    objMap[item] = value;
    var stringifiedMap = JSON.stringify(objMap);
    window.sessionStorage.setItem(vertical, stringifiedMap);
};

function goToProfile(vertical, withRegNo, regNumber) {
    setItemSession(vertical, 'regNoView', withRegNo);
    if (withRegNo) {
        setItemSession(vertical, 'premiumRequest', {});
    }
    //console.log(vertical)
    if (vertical && regNumber){
        appVerticalRedirection(vertical, regNumber)
    }
    else{
        appVerticalRedirection(vertical)
    }

}

function showError(field, message){
    let inputMessage = $(field).parents('.tm-field').addClass('error').find('.tm-message')
    $(inputMessage).text(message).addClass('tm-error').slideDown()
}

function showSuccess(field, message){
    let inputMessage = $(field).parents('.tm-field').removeClass('error').find('.tm-message')
    $(inputMessage).text(message).slideUp()
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function getAQuote(vehicleNoRegField){
    let vertical = getVertical()
    let regNumber = $(vehicleNoRegField).val().toUpperCase()
    let formID = vehicleNoRegField.closest('form').id;
    if (isValidRegNo(regNumber)){
        window.localStorage.setItem(vertical + 'registrationNo', regNumber);
        window.sessionStorage.setItem(vertical + 'registrationNo', regNumber);

        /*RegNo Cookie - Ashish TM - 20211227 start */
        setCookie('data', regNumber, '.turtlemint.com', null);
        /*RegNo Cookie - Ashish TM - 20211227 end */

        /*DataLayer 20210325 - start*/
        if(vertical=='FW'){
            dataLayer.push({'event': 'Registration Info', 'Product': 'Four-Wheeler Insurance', 'Registeration_Number': regNumber, });
        }
        if(vertical=='TW'){
            dataLayer.push({'event': 'Registration Info', 'Product': 'Two-Wheeler Insurance', 'Registeration_Number': regNumber, });
        }

        if(formID == 'get-a-quote-form' && vertical){
            gtag('event', 'Btn_click-Get a Quote', {
                'event_category': vertical+'_VP-Buttons',
                'event_label': 'Get a Quote'
            });
        }

        if(formID == 'get-a-quote-form-2' || formID == 'get-a-quote-form-3'){
            let formElement = document.getElementById(formID);
            if (formElement) {
                let cta = formElement.querySelector('.get-quote-cta');
                if (cta) {
                    tmClickEventData(cta);
                }
            }
        }

        /*DataLayer 20210325 - end*/
        goToProfile(vertical, true, regNumber);
    }else{
        /*DataLayer 20210325 - start*/
        if(vertical=='FW'){
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({'event': 'errorMessage','Error_Message': 'Registration number is incorrect', 'Error_URL': 'https://www.turtlemint.com/car-insurance'});

            gtag('event', vertical+'-Message-No_Input-RN', {
                'event_category': vertical+'_VP-error',
                'event_label': 'Please enter complete registration number'
            });
        }
        if(vertical=='TW'){
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({'event': 'errorMessage','Error_Message': 'Registration number is incorrect', 'Error_URL': 'https://www.turtlemint.com/two-wheeler-insurance/'});

            gtag('event', vertical+'-Message-No_Input-RN', {
                'event_category': vertical+'_VP-error',
                'event_label': 'Enter valid registration number'
            });
            
        }
        /*DataLayer 20210325 - end*/
        
        showError(vehicleNoRegField,'Enter valid registration number')
    }
}

function isValidPincode(pincode){
    return /^[1-9]{1}[0-9]{2}[0-9]{3}$/.test(pincode)
}

/* Get a quote form */
let getAQuoteForms = document.querySelectorAll(".get-a-quote-form");
if(getAQuoteForms){
    getAQuoteForms.forEach(form => {
        form.addEventListener("submit", async (event) => {
            event.preventDefault()
            let vehicleRegNo = form.querySelector('#regNumber')
            if(vehicleRegNo.value == ""){
                showError(vehicleRegNo,'Enter valid registration number')
            }else{
                getAQuote(vehicleRegNo)
            }
        });
    });
}

/* Find Advisor form */
let findAdvisorForm = document.getElementById("find-advisor-form"); 
if(findAdvisorForm){
    findAdvisorForm.addEventListener("submit", async (event) => {
        event.preventDefault()
        let pincode = document.getElementById('find-advisor-pincode')
        if(pincode.value == ""){
            showError(pincode,'Please enter the pincode')
        }else{
            if(isValidPincode(pincode.value)){
                showSuccess(pincode)
                let vertical = getVertical()
                sessionStorage.setItem('tm_vertical_data', vertical);
                let pincodeData = await getPincodeLocation(pincode.value)
                if(pincodeData.error){
                    showError(pincode, pincodeData.info)
                    gtag("event", vertical+"-Message-No_Input-Pincode",{event_category: vertical+"_VP-error",event_label:"No pincode found-"+pincode});
                }else{
                    showSuccess(pincode)
                    gtag("event","Btn_click-Find Advisor",{event_category: vertical+"_VP-Buttons",event_label:"Find Advisor"});
                    $(findAdvisorForm).submit()
                }
            }else{
                showError(pincode,'Please enter the valid pincode')
            }
        }
    });
}

/* CF7 No DP form */
/* jQuery("#empty-screen-wrap a.tm-button.large").click(function(){
    jQuery('.tmdatetime').attr("value", Date());
    jQuery('.verticalnodp').attr("value", getParameterByName('vertical'));
}); */