document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll(".accordion-button").forEach(e=>{e.addEventListener("click",function(){const t=document.querySelector(e.dataset.target);t&&(t.classList.toggle("show"),e.classList.toggle("collapsed"))})});const g=document.getElementById("accept-all-cookies"),u=document.getElementById("accept-selected-cookies"),k=document.getElementById("reject-optional-cookies"),n=document.getElementById("cookies-consent-banner"),i=document.getElementById("scify-cookie-consent-floating-button"),l=n.dataset.showFloatingButton==="true"||n.dataset.showFloatingButton==="1";let a=h("cookieConsent");m(),d();function y(){return window.location.href.includes("/cookie-policy")}function m(){y()?(n.style.display="block",l&&i&&(i.style.display="none")):a?(n.style.display="none",l&&i&&(i.style.display="block")):n.style.display="block"}function d(){if(a){const e=JSON.parse(a);for(const t in e){const o=document.getElementById(t);o&&(o.checked=e[t])}}}g.addEventListener("click",function(){const e={};document.querySelectorAll(".cookie-category").forEach(t=>{e[t.id]=!0}),r(e)}),u&&u.addEventListener("click",function(){const e={};document.querySelectorAll(".cookie-category").forEach(t=>{e[t.id]=t.checked}),r(e)}),k.addEventListener("click",function(){const e={};document.querySelectorAll(".cookie-category").forEach(t=>{e[t.id]=t.id==="strictly_necessary"}),r(e)});function r(e){fetch(n.dataset.ajaxUrl,{method:"POST",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")},body:JSON.stringify(e)}).then(t=>t.json()).then(t=>{if(t.success){p("cookieConsent",JSON.stringify(e),30),d(),y()||(n.style.display="none",l&&(i.style.display="block"));const o=document.createElement("div");o.classList.add("cookie-success-message"),o.innerText=t.message,document.body.appendChild(o),setTimeout(()=>{o.classList.add("show")},100),setTimeout(()=>{o.classList.remove("show"),setTimeout(()=>{o.remove()},1e3)},4e3),a=JSON.stringify(e),d()}})}window.toggleCookieBanner=function(){n.style.display==="none"||n.style.display===""?(n.style.display="block",l&&(i.style.display="none")):(n.style.display="none",l&&(i.style.display="block"))};const f=document.getElementById("cookie-policy-link");f&&f.addEventListener("click",function(){E("cookieConsent")});function p(e,t,o){let s="";{const c=new Date;c.setTime(c.getTime()+o*24*60*60*1e3),s="; expires="+c.toUTCString()}document.cookie=e+"="+(t||"")+s+"; path=/"}function h(e){const t=e+"=",o=document.cookie.split(";");for(let s=0;s<o.length;s++){let c=o[s];for(;c.charAt(0)===" ";)c=c.substring(1,c.length);if(c.indexOf(t)===0)return c.substring(t.length,c.length)}return null}function E(e){document.cookie=e+"=; Max-Age=-99999999;"}});