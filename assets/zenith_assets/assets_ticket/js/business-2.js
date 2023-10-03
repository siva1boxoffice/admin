/*! business-2.js | Huro | Css ninja 2020-2021 */
"use strict";$(document).ready((function(){var e={series:[{name:"New Users",data:[44,55,57,56,61,58,63,60,66]},{name:"Renewals",data:[76,85,101,98,87,105,91,114,94]},{name:"Resigns",data:[35,41,36,26,45,48,52,53,41]}],chart:{height:180,type:"area",toolbar:{show:!1},sparkline:{enabled:!0}},colors:[themeColors.purple,themeColors.accent,themeColors.orange],grid:{show:!1,padding:{left:0,right:0}},dataLabels:{enabled:!1},stroke:{width:[2],curve:"smooth"},xaxis:{type:"numeric",lines:{show:!1},axisBorder:{show:!1},labels:{show:!1}},yaxis:[{y:0,offsetX:0,offsetY:0,labels:{show:!1},padding:{left:0,right:0}}],tooltip:{x:{show:!1,format:"dd/MM/yy HH:mm"}}};new ApexCharts(document.querySelector("#users-chart"),e).render();var a={series:[{data:[21,22,10,28,16,21,13,30,35,41,36,26]}],chart:{height:180,type:"bar",toolbar:{show:!1},sparkline:{enabled:!0},events:{click:function(e,a,t){}}},colors:[themeColors.accent,themeColors.orange,themeColors.purple],plotOptions:{bar:{columnWidth:"30px",distributed:!0,endingShape:"rounded"}},dataLabels:{enabled:!1},legend:{show:!1},xaxis:{type:"numeric",lines:{show:!1},axisBorder:{show:!1},labels:{show:!1}},yaxis:[{y:0,offsetX:0,offsetY:0,labels:{show:!1},padding:{left:0,right:0}}]};new ApexCharts(document.querySelector("#shares-chart"),a).render();var t=bb.generate({data:{columns:[["data",91.4]],type:"gauge",onclick:function(e,a){console.log("onclick",e,a)},onover:function(e,a){console.log("onover",e,a)},onout:function(e,a){console.log("onout",e,a)}},gauge:{},color:{pattern:[themeColors.accent,themeColors.info,themeColors.orange,themeColors.green],threshold:{values:[30,60,90,100]}},size:{height:120},padding:{bottom:20},legend:{show:!1,position:"inset"},bindto:"#gauge-holder"});setTimeout((function(){t.load({columns:[["data",10]]})}),1e3),setTimeout((function(){t.load({columns:[["data",50]]})}),2e3),setTimeout((function(){t.load({columns:[["data",70]]})}),3e3),setTimeout((function(){t.load({columns:[["data",0]]})}),4e3),setTimeout((function(){t.load({columns:[["data",100]]})}),5e3);var s=[{x:"Jan",y:322},{x:"Feb",y:459},{x:"Mar",y:212},{x:"Apr",y:345},{x:"May",y:111},{x:"Jun",y:189},{x:"Jul",y:498},{x:"Aug",y:612},{x:"Sep",y:451},{x:"Oct",y:248},{x:"Nov",y:306},{x:"Dec",y:366}],o=[{x:"Jan",y:25},{x:"Feb",y:49},{x:"Mar",y:36},{x:"Apr",y:84},{x:"May",y:64},{x:"Jun",y:131},{x:"Jul",y:48},{x:"Aug",y:144},{x:"Sep",y:96},{x:"Oct",y:11},{x:"Nov",y:31},{x:"Dec",y:8}],n={series:[],chart:{height:235,type:"bar",toolbar:{show:!1}},colors:[themeColors.accent,themeColors.orange],dataLabels:{enabled:!1},noData:{text:"Loading..."},xaxis:{type:"category",tickPlacement:"on",labels:{rotate:-45,rotateAlways:!0}}},r=new ApexCharts(document.querySelector("#bar-chart"),n);r.render(),$.getJSON("https://my-json-server.typicode.com/apexcharts/apexcharts.js/yearly",(function(e){r.updateSeries([{name:"Renewals",data:s}]),$.getJSON("https://my-json-server.typicode.com/apexcharts/apexcharts.js/yearly2",(function(e){r.appendSeries({name:"subscriptions",data:o})}))}));feather.icons["more-horizontal"].toSvg();var i='\n        <div class="row-action">\n            <button class="button h-button is-dark-outlined">Profile</button>\n        </div>\n    ';new DataTable(document.querySelector("#users-datatable"),{pageSize:10,sort:{picture:!1,name:!0,location:!1,type:!0,action:!1},filters:{picture:!1,name:!1,location:!1,type:!1,action:!1},filterText:"Type to Filter... ",filterInputClass:"input",counterText:function(e,a,t,s,o){return"Showing "+t+" to "+s+" of "+o+" items."},counterDivSelector:".datatable-info span",pagingDivSelector:"#paging-first-datatable",firstPage:!1,lastPage:!1,nextPage:'<i class="fas fa-angle-right"></i>',prevPage:'<i class="fas fa-angle-left"></i>',afterRefresh:function(){"development"===env&&changeDemoImages(),initDropdowns()},data:[{picture:'\n                    <div class="h-avatar">\n                        <img class="avatar" src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/photos/8.jpg" alt="">\n                    </div>\n                ',name:'<span class="has-dark-text dark-inverted is-font-alt is-weight-600 rem-90">Erik Kovalsky</span>',location:"Los Angeles, CA",type:'\n                    <span class="tag is-rounded is-solid">Customer</span>\n                ',action:""+i},{picture:'\n                    <div class="h-avatar">\n                        <img class="avatar" src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/photos/7.jpg" alt="">\n                    </div>\n                ',name:'<span class="has-dark-text dark-inverted is-font-alt is-weight-600 rem-90">Alice Carasca</span>',location:"San Diego, CA",type:'\n                    <span class="tag is-rounded is-solid">Customer</span>\n                ',action:""+i},{picture:'\n                    <div class="h-avatar">\n                        <img class="avatar" src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/photos/13.jpg" alt="">\n                    </div>\n                ',name:'<span class="has-dark-text dark-inverted is-font-alt is-weight-600 rem-90">Tara Svenson</span>',location:"New York, NY",type:'\n                    <span class="tag is-rounded is-solid">Supplier</span>\n                ',action:""+i},{picture:'\n                    <div class="h-avatar">\n                        <img class="avatar" src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/photos/5.jpg" alt="">\n                    </div>\n                ',name:'<span class="has-dark-text dark-inverted is-font-alt is-weight-600 rem-90">Mary Lebowski</span>',location:"Houston, TX",type:'\n                    <span class="tag is-rounded is-solid">Customer</span>\n                ',action:""+i},{picture:'\n                    <div class="h-avatar">\n                        <span class="avatar is-fake is-info">\n                            <span>K</span>\n                        </span>\n                    </div>\n                ',name:'<span class="has-dark-text dark-inverted is-font-alt is-weight-600 rem-90">Kaylee Jennings</span>',location:"Los Angeles, CA",type:'\n                    <span class="tag is-rounded is-solid">Customer</span>\n                ',action:""+i}]});setTimeout((function(){"development"===env&&changeDemoImages(),adjustDropdowns(),customizeDatatable()}),1e3)}));