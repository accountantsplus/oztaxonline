function triggerGoogleMapsLoaded() {
    _jq(window).trigger('GoogleMapsLoaded');
}

function paGoogleMaps(wsx5Data) {

    var ERR_WIDTH = 400;
    
    var jqContainer = _jq('#' + wsx5Data.id);

    function overrideConsole(old) {
        return wsx5Data.isPreview ? {
            log: old.log,
            info: old.info,
            warn: old.warn,
            error: function (msg) {
                old.error(msg);
                var details = _jq('<div style="width:' + ERR_WIDTH + 'px;height:' + ERR_WIDTH + 'px;"><pre style="margin-top:8px;margin-left:0px;word-wrap: break-word;white-space: pre-wrap;border:0; max-width:100%;font-family:monospace;">' + msg + '</pre></div>');
                buildJQErrorDiv(details);
                jqContainer.append(details);
            }
        } : old;
    }
    window.console = overrideConsole(window.console);

    function buildJQErrorDiv(jqDetailsObj) {
        if (wsx5Data.isPreview) {
            jqDetailsObj.addClass('error_post_content').hide();

            var jqImg = _jq('<div class="error_post_thumb"><img src="data:image/gif;base64,R0lGODlhEAAQAPcAAAAAAFBQUFVUUVpYU5qIZqOQaKiTaraebryjcL6kcM2wdevGfe3Ifu3If76+vu3Kg+3Lhu7Ni+3Nje7Rl+7Unu7Wpe/Xqe/bte/euu/hxO/ixu/kzfDo2O7r5+3t7fDs5PHv6/Hv7PDv7fHx8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAP8ALAAAAAAQABAAAAh9AP8JHEiwoMF/IDJ0OFjQAwUGFBgWZEBxg8R/IiRQZCDhIgYGBQIUYICB4YcHIEUyeMDQAkUDAwxQtFDQAYcGFEOOZNCAQ8EJGxMEULBxwoiBGjYqVapBYIgISg8IQKA0Qoh/F5YSUKn0wj+USxcsXfmvAoSzaNOirXDxYEAAOw=="/></div>');

            var jqDetailsBtn = _jq('<a class="err_more_details" href="#" target="_blank">' + wsx5Data.detailsLbl + '</a>')
                .bind('click', function (e) { e.preventDefault(); jqDetailsObj.toggle(); });

            var jqP = _jq('<p></p>').append(jqDetailsBtn);

            var jqMsgContainer = _jq('<div class="error_post_content p_error_ui">' + wsx5Data.errorMsg + '<br></div>').append(jqP);

            jqContainer.append(_jq('<div class="error_post_container"></div>').append(jqImg).append(jqMsgContainer));
        }
    }

    var obj = {};
    obj.createIFrame = function (url) {
        _jq.ajax(url).always(function (data, status, el) {
            var bError = status === 'error' && wsx5Data.isPreview;
            var iframe = _jq('<iframe width="' + (bError ? ERR_WIDTH : "100%") + '" height="' + (bError ? ERR_WIDTH : "100%") + '" frameborder="0" style="border:0; max-width: 100%; vertical-align: bottom;" src="' + url + '"></iframe>');
            if (bError) {
                buildJQErrorDiv(iframe);
            }
            jqContainer.append(_jq('<div class="container ' + (wsx5Data.fullWidth ? 'fullWidth' : 'normalWidth') + '" />').append(_jq('<div class="map_container" />').append(iframe)));            
        });
    }
    obj.loadMap = function (address) {
        new google.maps.Geocoder().geocode({ address: address }, function (results, status) {
            var lat = results[0].geometry.location.lat();
            var lng = results[0].geometry.location.lng();
            obj.createIFrame(wsx5Data.url + lat + ',' + lng);
        });
    }
    obj.loadGMAPI = function (key) {
        var gm_script = _jq('#gm_script');
        if (gm_script.length === 0) {
            jqContainer.append('<script id="gm_script" src=\"https://maps.googleapis.com/maps/api/js?key=' + key + '&callback=triggerGoogleMapsLoaded\" async defer></script>')
        }
    }
    return obj;
}