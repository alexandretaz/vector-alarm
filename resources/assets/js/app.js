
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
require('jquery');
var maxAlarm = 0;
var maxHelp = 0;
$(document).on('ready', function(){
    $.ajax({
        url: '/api/V1/calls',
        method:'get',
        dataType:'json',
        sucess:function(data){
            $("#callNumbers").html(data.openCalls);
            maxAlarm = data.lastAlarm;
            maxHelp = data.lastHelp;
        }
    }).done(function(data){
        console.dir(data);
    });


    window.setTimeout(function(){
        $.ajax({
            url: '/api/V1/lastcall/'+maxAlarm+'/'+maxHelp,
            method:'get',
            dataType:'json',
            sucess:function(data){
                $("#callNumbers").html(data.openCalls);
                if(data.lastAlarm>maxAlarm || data.lastHelp>maxHelp){
                    new Audio('/alarm.mp3').play();
                    maxAlarm = data.lastAlarm;
                    maxHelp = data.lastHelp;
                    alert('Você tem novos chamados');
                }
            }
        }).done(function (data) {
            console.dir(data);
        });
    }, 1000);
});

