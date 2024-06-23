const REDIRECT_CONFIG = [
    {
        "source": "https://*/life-insurance/*",
        "target": "https://www.turtlemint.parasite.turtle-feature.com/insurance-advisor-near-me/?vertical=Life",
        "verticalName": "Life"
    },
    {
        "source": "https://*/car-insurance/*",
        "target": "https://www.turtlemint.parasite.turtle-feature.com/insurance-advisor-near-me/?vertical=FW",
        "verticalName": "4 Wheeler"
    },
    {
        "source": "https://*/two-wheeler-insurance/*",
        "target": "https://www.turtlemint.parasite.turtle-feature.com/insurance-advisor-near-me/?vertical=TW",
        "verticalName": "2 Wheeler"
    },
    {
        "source": "https://*/health-insurance/*",
        "target": "https://www.turtlemint.parasite.turtle-feature.com/insurance-advisor-near-me/?vertical=Health",
        "verticalName": "Health"
    }
];

(function() {
    const style = document.createElement("style")
    style.innerHTML = `
    #advisor__widget{
        position: fixed;
        right: 20px;
        bottom: 20px;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 999;
        transition: 0.5s;
        transform: scale(0);
        animation: popout 0.5s cubic-bezier(0.35, 0.23, 1, 1.34) forwards;
        width: auto;
        //display: none;
    }
    #advisor__widget p{
        font-weight: 600;
        font-size: 14px;
        line-height: 17px;
        color: #505050;
        background-color: #FFE8BA;
        box-shadow: 0px 4.74336px 18.9735px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        padding: 2px 8px;
        max-width: 135px;
        transition: 0.5s;
        text-align: center;
        margin: 0;
        box-sizing: border-box;
        position: relative;
    }
    #advisor__widget span{
        display: block;
        transition: 0.5s;
        max-width: 100%;
        overflow: hidden;
        //animation: hidetext 0.5s linear 4s forwards, hidetext 0.5s linear 9s reverse forwards, hidetext 0.5s linear 14s forwards, hidetext 0.5s linear 19s reverse forwards, hidetext 0.5s linear 24s forwards ;
    }
    #advisor__widget img{
        margin-bottom: -15px;
        filter: drop-shadow(0px 11.8584px 35.5752px rgba(0, 0, 0, 0.25));
        width: 85px;
    }
    @media (max-width: 767.98px){
        #advisor__widget{
            right: 20px;
            bottom: 60px;
        }
        #advisor__widget img{
            width: 72px;
            margin-bottom: -12px;
            filter: drop-shadow( 0px 10px 30px rgba(0, 0, 0, 0.25));
        }
        #advisor__widget p{
            font-size: 12px;
            line-height: 15px;
            padding: 2px 7px;
            box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            max-width: 114px;
        }
    }
    @keyframes popout{
        0%{
            transform: scale(0);
            opacity: 0;
        }
        100%{
            transform: scale(1);
            opacity: 1;
        }
    }
    @keyframes hidetext{
        0%{
            height: 15px;
            width: 111px;
            opacity: 1;
        }
        20%, 80%{
            opacity:0;
        }
        100%{
            height: 0;
            width: 0;
            opacity: 0;
        }
    }
    `;
    const widget = document.createElement("div");
    widget.setAttribute("id", "advisor__widget");
    widget.setAttribute("onclick", "redirect()");
    widget.innerHTML=`<img src="https://www.turtlemint.parasite.turtle-feature.com/wp-content/uploads/advisor-widget.png" alt="Advisor wiget avatar"><p>Get Free Advice<span></span></p>`;
    document.body.append(style,widget) ;
})();

//let analytic = require ('turtlefin-analytics-wrapper');

window.dataLayer = window.dataLayer || [];

async function redirect(){
    const sourceURL = window.location.href;
    let targetURL = "https://www.turtlemint.parasite.turtle-feature.com/insurance-advisor-near-me/"
    try{
        // let response = await fetch('https://www.turtlemint.parasite.turtle-feature.com/find-advisor-widget/redirect-config.json');
        // let data = await response.json();
        let data = REDIRECT_CONFIG;
        if(data.length > 0){
            // let matchURL = data.find(e=>e.source == sourceURL)
            let matchURL = data.find(e => {
                // let formatedSubUrl = e.source.replace(/[\/.*+?^${}()|[\]\\]/g, '\\$&')
                // let formatedUrl = `^${formatedSubUrl}.*$`
                let formatedSubUrl = e.source.replace(/[\/.+?^${}()|[\]\\]/g, '\\$&').replaceAll('*','.*')
                let formatedUrl = `^${formatedSubUrl}$`
                let regExp = new RegExp(formatedUrl)
                // console.log(sourceURL,"\n",formatedSubUrl,"\n",formatedUrl,"\n",regExp,"\n",regExp.test(sourceURL))
                return regExp.test(sourceURL)
            })
            //matchURL ? targetURL = matchURL.target : "";
            if(matchURL){

                targetURL = matchURL.target;
                let targetVertical = matchURL.verticalName;

                    dataLayer.push(
                    {
                        eventName: 'Find_Advisor_Widget',
                        gaAction: 'Find_Advisor_Widget_Click',
                        gaLabel: 'Find_Advisor_Widget-'+targetVertical,
                        gaValue: 'Find_Advisor_Widget-'+targetVertical,
                        gaCategory: 'Find_Advisor_Widget',
                        event: "track_events",
                        deviceType: window.outerWidth < 767 ? 'mobile': 'desktop',
                        "time" : new Date(),
                        userFlow:'b2c',
                        source: "vertical"
                    }
                )
            }
        }
    }
    catch(e){
        console.error(e)
    }
    finally{
        location.href = targetURL;
    }
}