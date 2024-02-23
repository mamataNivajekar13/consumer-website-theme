const lazyLoadedImages = document.querySelectorAll('.remove-lazy-cover .wp-block-cover__image-background')
if(lazyLoadedImages){
    lazyLoadedImages.forEach(image => {
    image.removeAttribute('loading');
})
}

const VERTICAL_JSON = {
    'TW': 'Bike',
    'FW': 'Car',
    'Life': 'Life',
    'Health': 'Health'
}

const LIMIT = 9;
const SERVER = find_advisor_settings.fa_server_1;
const SERVER_2 = find_advisor_settings.fa_server_2;
const API_KEY = find_advisor_settings.fa_api_key;

async function getPincodeLocation(pincode){
    try{
        let headersList = {
        "Content-Type": "application/json",
        "APIkey": API_KEY
        }
        let response = await fetch(SERVER+"/api/agent-locator/pin-details/"+pincode, { 
            method: "GET",
            headers: headersList
        });
        let data = await response.json();
        //console.log(data)
        if(!(data.status == 'failure')){
            
            sessionStorage.setItem('tm_pincode_data', JSON.stringify(data))
            $('#pincode-filter-input').text(pincode)
            return data;
        }
        else{
            throw 'Pincode not found';
        }
    }
    catch(err){
      let invalidPincodeVertical = sessionStorage.getItem('tm_vertical_data');
      if(invalidPincodeVertical != null){
          //console.log('Pincode not found-'+ pincode + ', vertical-' + invalidPincodeVertical)
          gtag('event', 'DPL-'+invalidPincodeVertical+'-Message-Invalid-Pincode', { 
              'event_category': 'DPL_Popup',
              'event_label': 'Pincode not found-'+ pincode
          });
      }else{
          //console.log('null vertical')
      }

        return {
            'error': true,
            'info': 'Pincode not found',
            'data': err
        }
    }
}

async function getAdvisorList(pincode, vertical, offset=0, returnData=false) {
    try{
        parseInt(offset) == 0 ? window.tm_offset = 0: '';
        let headersList = {
        "Content-Type": "application/json",
        "APIkey": API_KEY
        }
        let bodyContent = JSON.stringify({
            "pinCode": pincode,
            "vertical": vertical
        });
        let response = await fetch(SERVER+"/api/agent-locator/advisors?offset="+offset+"&limit="+LIMIT, { 
            method: "POST",
            body: bodyContent,
            headers: headersList
        });
        let data = await response.json();
      //   console.log(data)
        window.tm_total_advisor_count = data.totalEligibleAdvisorCount;
        window.tm_added_advisor_count = window.tm_added_advisor_count ? window.tm_added_advisor_count + data.advisors.length : window.tm_offset * LIMIT + data.advisors.length;
        if(returnData){ 
          return data;
        }
      //   renderContent(data)
        data.advisors && data.advisors.length > 0 ? renderContent(data): renderEmptyScreen();
    }
    catch(err){
        console.log('Get Advisor List error:', err)
        if(returnData){ return {"error": true, "info": err } }
      //   TODO replace renderContent with renderEmptyScreen
      //   renderContent(data)
        renderEmptyScreen()
    }
}

function renderContent(data){
    let firstFoldParent = document.getElementById('firstFoldList')
    let lastFoldParent = document.getElementById('lastFoldList');
    let htmlFirstFold = ''
    let htmlLastFold = ''
  //   console.log(data.advisors.slice(3))
    data.advisors.slice(0, 3).forEach( advisor => {
        htmlFirstFold += `<div class="tm-advisor-wrap">
        <div class="advisor-card">
            <div class="advisor-card__wraper">
                <a target="_blank" href="https://advisor.turtlemint.com/profile/${advisor.dpNo}/${advisor.partnerName}" class="tm-link tm-redirect" onclick="gtag('event', 'DPL-Partner_Website-Linkclicks', {event_category:'LinkClicks',event_label: 'Link-click Visit Website'});">Visit Website</a>
                <div class="advisor-image">
                    ${ advisor.profilePicUrl ? '<img src="'+SERVER_2+'/api/files/v1/view/'+advisor.profilePicUrl+'?broker=turtlemint" alt="'+VERTICAL_JSON[sessionStorage.getItem('tm_vertical_data')]+' Insurance advisor in '+advisor.city+'" onerror="this.style.display=\'none\'">' : '' }
                </div>
                <p class="tm-h2-bold advisor-name" title="${advisor.partnerName.toUpperCase()}">${advisor.partnerName}</p>
                <p class="tm-body tm-grey-text advisor-location">${advisor.area}</p>
                <div class="row tm-stats">
                    <div class="stat">
                        <p class="tm-h2-regular stat-title">${Math.floor(advisor.yearsOfExperience)} Years</p>
                        <p class="tm-body tm-grey-text stat-subtitle">Experience</p>
                    </div>
                    <div class="stat">
                        <p class="tm-h2-regular stat-title">${Math.floor(advisor.customersServed)}+</p>
                        <p class="tm-body tm-grey-text stat-subtitle">Policies Sold</p>
                    </div>
                </div>
                <a onclick="openPopup('getInTouchPopup', '${advisor.partnerName}', '${advisor.partnerId}')" class="tm-button">Get In Touch</a>
                <br/>
            </div>
        </div>
    </div>`
    });
    if(data.advisors.length > 3){
        data.advisors.slice(3).forEach( advisor => {
            htmlLastFold += `<div class="tm-advisor-wrap">
            <div class="advisor-card">
                <div class="advisor-card__wraper">
                    <a target="_blank" href="https://advisor.turtlemint.com/profile/${advisor.dpNo}/${advisor.partnerName}" class="tm-link tm-redirect" onclick="gtag('event', 'DPL-Partner_Website-Linkclicks', {event_category:'LinkClicks',event_label: 'Link-click Visit Website'});">Visit Website</a>
                    <div class="advisor-image">
                    ${ advisor.profilePicUrl ? '<img src="'+SERVER_2+'/api/files/v1/view/'+advisor.profilePicUrl+'?broker=turtlemint" alt="'+VERTICAL_JSON[sessionStorage.getItem('tm_vertical_data')]+' Insurance advisor in '+advisor.city+'" onerror="this.style.display=\'none\'">' : '' }
                    </div>
                    <p class="tm-h2-bold advisor-name" title="${advisor.partnerName.toUpperCase()}">${advisor.partnerName}</p>
                    <p class="tm-body tm-grey-text advisor-location">${advisor.area}</p>
                    <div class="row tm-stats">
                        <div class="stat">
                            <p class="tm-h2-regular stat-title">${Math.floor(advisor.yearsOfExperience)} Years</p>
                            <p class="tm-body tm-grey-text stat-subtitle">Experience</p>
                        </div>
                        <div class="stat">
                            <p class="tm-h2-regular stat-title">${Math.floor(advisor.customersServed)}+</p>
                            <p class="tm-body tm-grey-text stat-subtitle">Policies Sold</p>
                        </div>
                    </div>
                    <a onclick="openPopup('getInTouchPopup', '${advisor.partnerName}', '${advisor.partnerId}')" class="tm-button">Get In Touch</a>
                    <br/>
                </div>
            </div>
        </div>`
        });
    }
  //   console.log(htmlFirstFold)
  //   console.log(htmlLastFold)
    firstFoldParent.innerHTML = htmlFirstFold;
    lastFoldParent.innerHTML = data.advisors.length > 3 ? htmlLastFold : '';
    let agentCountText = `${data.totalEligibleAdvisorCount ? data.totalEligibleAdvisorCount : data.advisors.length} ${VERTICAL_JSON[sessionStorage.getItem('tm_vertical_data')]} Insurance Advisors`
    $('.agent-count-js').text(agentCountText)
    let url = new URL(window.location);
    sessionStorage.getItem('tm_pincode_data') ? url.searchParams.set('pincode', JSON.parse(sessionStorage.getItem('tm_pincode_data')).pinCode) : '';
    sessionStorage.getItem('tm_vertical_data') ? url.searchParams.set('vertical', sessionStorage.getItem('tm_vertical_data')) : '';
    window.tm_offset || window.tm_offset === 0 ? url.searchParams.set('offset', window.tm_offset): '';
    window.history.pushState(null, '', url.toString());
    $('.advisor-list-wraper').removeClass('d-none')
    $('#empty-screen-wrap').addClass('d-none')
    $('#pincodeForm .tm-button').removeClass('tm-loader')
    populateVertical()
    closePopup('pincodePopup')
    $('#pincodeForm .filter-form-group').addClass('d-none')
    $('.tm-loading').removeClass('tm-loading')
    window.addEventListener("scroll", handleInfiniteScroll);
}

function renderEmptyScreen () {
    let url = new URL(window.location);
    sessionStorage.getItem('tm_pincode_data') ? url.searchParams.set('pincode', JSON.parse(sessionStorage.getItem('tm_pincode_data')).pinCode) : '';
    sessionStorage.getItem('tm_vertical_data') ? url.searchParams.set('vertical', sessionStorage.getItem('tm_vertical_data')) : '';
    window.tm_offset || window.tm_offset === 0 ? url.searchParams.set('offset', window.tm_offset): '';
    window.history.pushState(null, '', url.toString());
    $('.advisor-list-wraper').addClass('d-none')
    $('#empty-screen-wrap').removeClass('d-none')

    gtag('event', 'No_DPL-'+sessionStorage.getItem('tm_vertical_data'), {'event_category': 'No_DPL-Page', 'event_label': 'No_DPL-PV'});

    $('#pincodeForm .tm-button').removeClass('tm-loader')
    populateVertical()
    closePopup('pincodePopup')
    $('.tm-loading').removeClass('tm-loading')
}
function filterVertical(){
  $('.tm-preloader').addClass('tm-loading')
  window.tm_added_advisor_count = 0;
  getAdvisorList(JSON.parse(sessionStorage.getItem('tm_pincode_data')).pinCode, sessionStorage.getItem('tm_vertical_data'))
}
//render script end


//infinite scrolling
async function renderNextPage(){
  $('#paginationLoader').removeClass('d-none')
  window.tm_offset = window.tm_offset + 1;
  let data = await getAdvisorList(JSON.parse(sessionStorage.getItem('tm_pincode_data')).pinCode, sessionStorage.getItem('tm_vertical_data'), window.tm_offset, true)
  // console.log(data)
  let lastFoldParent = document.getElementById('lastFoldList');
  let html = '';
  if(data.advisors && data.advisors.length > 0){
      data.advisors.forEach( advisor => {
        html += `<div class="tm-advisor-wrap">
            <div class="advisor-card">
                <div class="advisor-card__wraper">
                    <a target="_blank" href="https://advisor.turtlemint.com/profile/${advisor.dpNo}/${advisor.partnerName}" class="tm-link tm-redirect" onclick="gtag('event', 'DPL-Partner_Website-Linkclicks', {event_category:'LinkClicks',event_label: 'Link-click Visit Website'});">Visit Website</a>
                    <div class="advisor-image">
                    ${ advisor.profilePicUrl ? '<img src="'+SERVER_2+'/api/files/v1/view/'+advisor.profilePicUrl+'?broker=turtlemint" alt="'+VERTICAL_JSON[sessionStorage.getItem('tm_vertical_data')]+' Insurance advisor in '+advisor.city+'" onerror="this.style.display=\'none\'">' : '' }
                    </div>
                    <p class="tm-h2-bold advisor-name" title="${advisor.partnerName.toUpperCase()}">${advisor.partnerName}</p>
                    <p class="tm-body tm-grey-text advisor-location">${advisor.area}</p>
                    <div class="row tm-stats">
                        <div class="stat">
                            <p class="tm-h2-regular stat-title">${Math.floor(advisor.yearsOfExperience)} Years</p>
                            <p class="tm-body tm-grey-text stat-subtitle">Experience</p>
                        </div>
                        <div class="stat">
                            <p class="tm-h2-regular stat-title">${Math.floor(advisor.customersServed)}+</p>
                            <p class="tm-body tm-grey-text stat-subtitle">Policies Sold</p>
                        </div>
                    </div>
                    <a onclick="openPopup('getInTouchPopup', '${advisor.partnerName}', '${advisor.partnerId}')" class="tm-button">Get In Touch</a>
                    <br/>
                </div>
            </div>
        </div>`
      });
  }
  let url = new URL(window.location);
  sessionStorage.getItem('tm_pincode_data') ? url.searchParams.set('pincode', JSON.parse(sessionStorage.getItem('tm_pincode_data')).pinCode) : '';
  sessionStorage.getItem('tm_vertical_data') ? url.searchParams.set('vertical', sessionStorage.getItem('tm_vertical_data')) : '';
  window.tm_offset || window.tm_offset === 0 ? url.searchParams.set('offset', window.tm_offset): '';
  window.history.pushState(null, '', url.toString());
  $('#paginationLoader').addClass('d-none')
  lastFoldParent.innerHTML += html;
  window.addEventListener("scroll", handleInfiniteScroll);
}
async function handleInfiniteScroll() {
    let lastFoldListSection = document.getElementById('lastFoldList');
    const endOfPage = window.innerHeight + window.pageYOffset >= lastFoldListSection.offsetTop + lastFoldListSection.offsetHeight;

    if (endOfPage) {
      removeInfiniteScroll()
      await renderNextPage()
      // console.log("page end: Run fetch")
    }

    if (window.tm_total_advisor_count <= window.tm_added_advisor_count) {
      removeInfiniteScroll();
    }
};

function removeInfiniteScroll() {
  // loader.remove();
  window.removeEventListener("scroll", handleInfiniteScroll);
};
//infinite scrolling end