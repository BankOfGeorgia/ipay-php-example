let f = function () {
    const sdkStyle = "@font-face{font-family:MarkGEOCAPS;src:url(https://webstatic.bog.ge/fonts/markgeo/MarkGEOCAPS-Medium/MarkGEOCAPS-Medium.eot);src:url(https://webstatic.bog.ge/fonts/markgeo/MarkGEOCAPS-Medium/MarkGEOCAPS-Medium.woff2) format('woff2'),url(https://webstatic.bog.ge/fonts/markgeo/MarkGEOCAPS-Medium/MarkGEOCAPS-Medium.woff) format('woff'),url(https://webstatic.bog.ge/fonts/markgeo/MarkGEOCAPS-Medium/MarkGEOCAPS-Medium.ttf) format('truetype'),url(https://webstatic.bog.ge/fonts/markgeo/MarkGEOCAPS-Medium/MarkGEOCAPS-Medium.svg#MarkGEOCAPS-Medium) format('svg'),url(https://webstatic.bog.ge/fonts/markgeo/MarkGEOCAPS-Medium/MarkGEOCAPS-Medium.eot?#iefix) format('embedded-opentype');font-weight:500;font-style:normal;font-display:swap}.ipay-parent-block-default{position:relative;margin:0;padding:0;width:280px;height:48px}.ipay-button-block-default{position:absolute;left:0;width:134px}.ipay-payment-methods-default{position:absolute;right:0;width:139px;line-height:55px}.ipay-sdk-pay-default{cursor:pointer;width:134px;height:48px;border-radius:4px;box-shadow:0 2px 4px 0 rgba(0,0,0,.1);background-color:#fc6719;border:none;outline:0;transition:background-color .2s ease-in-out 0s,box-shadow .2s ease-in-out 0s}.ipay-sdk-pay-default:active{background-color:#f6661c}.ipay-sdk-pay-default:hover{background-color:#f68448;box-shadow:rgba(0,0,0,.1) 0 4px 8px 0}.ipay-sdk-pay-default:focus{background-color:#f6661c}.ipay-sdk-pay-default span{font-family:MarkGEOCAPS;font-size:14px;font-weight:500;font-style:normal;font-stretch:normal;line-height:3.71;letter-spacing:normal;text-align:left;color:#fff}.b-1-default{width:138.2px;height:17.4px;object-fit:contain;line-height:30px}.ipay-parent-block-light{position:relative;margin:0;padding:0;width:280px;height:48px}.ipay-button-block-light{position:absolute;left:0;width:134px}.ipay-payment-methods-light{position:absolute;right:0;width:139px;line-height:55px}.ipay-sdk-pay-light{cursor:pointer;width:134px;height:48px;border-radius:4px;box-shadow:0 2px 4px 0 rgba(0,0,0,.1);background-color:#f5f5f5;border:none;outline:0;transition:background-color .2s ease-in-out 0s,box-shadow .2s ease-in-out 0s}.ipay-sdk-pay-light:active{background-color:#f5f5f5}.ipay-sdk-pay-light:hover{background-color:#f5f5f5;box-shadow:rgba(0,0,0,.1) 0 4px 8px 0}.ipay-sdk-pay-light:focus{background-color:#f5f5f5}.ipay-sdk-pay-light span{font-family:MarkGEOCAPS;font-size:14px;font-weight:500;font-style:normal;font-stretch:normal;line-height:3.71;letter-spacing:normal;text-align:left;color:#3d3d3d}.b-1-light{width:138.2px;height:17.4px;object-fit:contain;line-height:30px}.ipay-parent-block-dark{display:block;margin:0;padding:0;width:268px;height:48px}.ipay-button-block-dark{width:268px}.ipay-payment-methods-dark{width:139px;line-height:55px;margin:auto}.ipay-sdk-pay-dark{cursor:pointer;width:268px;height:48px;border-radius:4px;box-shadow:0 2px 4px 0 rgba(0,0,0,.1);background-color:#f5f5f5;border:none;outline:0;transition:background-color .2s ease-in-out 0s,box-shadow .2s ease-in-out 0s}.ipay-sdk-pay-dark:active{background-color:#f5f5f5}.ipay-sdk-pay-dark:hover{background-color:#f5f5f5;box-shadow:rgba(0,0,0,.1) 0 4px 8px 0}.ipay-sdk-pay-dark:focus{background-color:#f5f5f5}.ipay-sdk-pay-dark span{font-family:MarkGEOCAPS;font-size:14px;font-weight:500;font-style:normal;font-stretch:normal;line-height:3.71;letter-spacing:normal;text-align:left;color:#3d3d3d}.b-1-dark{width:138.2px;height:17.4px;object-fit:contain;line-height:30px}.ipay-parent-block-bright{margin:0;padding:0;width:268px;height:48px}.ipay-button-block-bright{width:268px}.ipay-payment-methods-bright{width:139px;line-height:55px;margin:auto}.ipay-sdk-pay-bright{cursor:pointer;width:268px;height:48px;border-radius:4px;box-shadow:0 2px 4px 0 rgba(0,0,0,.1);background-color:#fc6719;border:none;outline:0;transition:background-color .2s ease-in-out 0s,box-shadow .2s ease-in-out 0s}.ipay-sdk-pay-bright:active{background-color:#f6661c}.ipay-sdk-pay-bright:hover{background-color:#f68448;box-shadow:rgba(0,0,0,.1) 0 4px 8px 0}.ipay-sdk-pay-bright:focus{background-color:#f6661c}.ipay-sdk-pay-bright span{font-family:MarkGEOCAPS;font-size:14px;font-weight:500;font-style:normal;font-stretch:normal;line-height:3.71;letter-spacing:normal;text-align:left;color:#fff}.b-1-bright{width:138.2px;height:17.4px;object-fit:contain;line-height:30px}";
    /**
     * Default config parameters
     */

    const checkoutTag = 'ipay-checkout';
    const defaultMethod = 'post';
    const defaultProperties = {
        name: 'IPaySDK',
        class: 'ipay-sdk-pay',
        id: 'ipay-sdk-pay-1',
        href: '',
        title: 'Pay with iPay',
        alt: 'Pay with iPay',
        target: '_blank',
        text: 'áƒ§áƒ˜áƒ“áƒ•áƒ',
        cssStyle: '',
        data: [{
            value: 'test',
            name: 'test',
            class: '',
            type: 'hidden'
        }]
    };

    let generateDiffParams = function (requestedProps, defProps) {
        const diffParams = Object.assign({}, defProps);

        if (requestedProps !== undefined) {
            Object.keys(defProps).forEach(key => {
                if (requestedProps[key]) {
                    diffParams[key] = requestedProps[key];
                }
            });
        }

        return diffParams;
    };

    let themes = {
        default: function (parentNode, properties, theme) {
            createHtml(parentNode, properties, theme, 'https://webstatic.bog.ge/ipay/payment-method-light.svg', 'b-1');
        },
        light: function (parentNode, properties, theme) {
            createHtml(parentNode, properties, theme, 'https://webstatic.bog.ge/ipay/payment-method-dark.svg', 'b-1');
        },
        dark: function (parentNode, properties, theme) {
            createHtml(parentNode, properties, theme, 'https://webstatic.bog.ge/ipay/payment-method-light.svg', 'b-1');
        },
        bright: function (parentNode, properties, theme) {
            createHtml(parentNode, properties, theme, 'https://webstatic.bog.ge/ipay/payment-method-dark.svg', 'b-1');
        }
    };

    Object.size = function (obj) {
        var size = 0,
            key;

        for (key in obj) {
            if (obj.hasOwnProperty(key)) size++;
        }

        return size;
    }; // Load CDN CSS
    // const link = document.createElement("link");
    // link.href = cdnCSS;
    // link.type = "text/css";
    // link.rel = "stylesheet";
    // link.media = "screen, print";
    // document.getElementsByTagName("head")[0].appendChild(link);


    let createHtml = function (parentNode, properties, theme, imgResource, imgResourceCls) {
        parentNode.innerHTML = '';
        const divNode = document.createElement("div");
        divNode.setAttribute('class', 'ipay-parent-block-' + theme);
        parentNode.appendChild(divNode);
        const cssStyle = document.createElement("style");
        cssStyle.setAttribute('type', 'text/css');
        cssStyle.innerHTML = sdkStyle;
        parentNode.appendChild(cssStyle);
        const buttonNode = document.createElement("div");
        buttonNode.setAttribute('class', 'ipay-button-block-' + theme);
        divNode.appendChild(buttonNode);
        const formWrapper = document.createElement("form");
        formWrapper.setAttribute('method', defaultMethod);
        formWrapper.setAttribute('action', generateDiffParams(properties, defaultProperties).href);
        buttonNode.appendChild(formWrapper);
        const data = generateDiffParams(properties, defaultProperties).data; // secure check must!!!

        if (Object.size(data) > 0) {
            for (var key in data) {
                //let isHidden = data[key].hasOwnProperty('hidden') && data[key].hidden === true ? 'hidden' : '';
                if (data.hasOwnProperty(key)) {
                    let additionalInputs = document.createElement("input");
                    additionalInputs.setAttribute('type', data[key].type);
                    additionalInputs.setAttribute('value', data[key].value);
                    additionalInputs.setAttribute('id', 'id-' + key);
                    additionalInputs.setAttribute('class', data[key].class);
                    additionalInputs.setAttribute('name', data[key].name);
                    formWrapper.appendChild(additionalInputs);
                }
            }
        }

        const buttonWrapper = document.createElement("button");
        buttonWrapper.setAttribute('class', generateDiffParams(properties, defaultProperties).class + '-' + theme);
        buttonWrapper.setAttribute('id', generateDiffParams(properties, defaultProperties).id + '-' + theme);
        buttonWrapper.setAttribute('title', generateDiffParams(properties, defaultProperties).title);
        buttonWrapper.setAttribute('alt', generateDiffParams(properties, defaultProperties).alt);
        buttonWrapper.setAttribute('formtarget', generateDiffParams(properties, defaultProperties).target);
        formWrapper.appendChild(buttonWrapper);
        const spanWrapper = document.createElement("span");
        spanWrapper.textContent = generateDiffParams(properties, defaultProperties).text;
        buttonWrapper.appendChild(spanWrapper); // payment methods

        const methodWrapper = document.createElement("div");
        methodWrapper.setAttribute('class', 'ipay-payment-methods-' + theme);
        divNode.appendChild(methodWrapper);
        const payMethodNode = document.createElement("img");
        payMethodNode.setAttribute('src', imgResource);
        payMethodNode.setAttribute('class', imgResourceCls + '-' + theme);
        methodWrapper.appendChild(payMethodNode);
    }; // Parse query string from script tag


    let parseQueryString = function (name) {
        const script_tag = document.getElementById('SDK');
        const query = script_tag.src.replace(/^[^\?]+\??/, '');
        const vars = query.split("&");
        const args = {};

        for (let i = 0; i < vars.length; i++) {
            let pair = vars[i].split("=");
            args[pair[0]] = decodeURI(pair[1]).replace(/\+/g, ' ');
        }

        return args[name];
    };

    window.IpaySDK = function () {
        return {
            Render: function (type, properties, element) {
                let parentNode;

                if (element) {
                    parentNode = element;
                } else {
                    parentNode = document.getElementsByTagName(checkoutTag)[0];

                    if (parentNode === undefined) {
                        throw '[ipay-checkout] is not defined';
                    }
                }

                if (type === undefined || type === null) {
                    throw 'type is not defined';
                }

                if (typeof type === 'string' || type instanceof String) {
                    switch (type) {
                        case 'default':
                            themes.default(parentNode, properties, type);
                            break;

                        case 'light':
                            themes.light(parentNode, properties, type);
                            break;

                        case 'dark':
                            themes.dark(parentNode, properties, type);
                            break;

                        case 'bright':
                            themes.bright(parentNode, properties, type);
                            break;
                    }
                } else {
                    throw 'incorrect type of render';
                }
            }
        };
    }();

    const callback = parseQueryString('callback');

    if (callback && window[callback]) {
        window[callback]();
    }
};

f();