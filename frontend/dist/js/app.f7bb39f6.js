(function(){"use strict";var e={2969:function(e,n,t){var r=t(9242),o=t(3396),i=t.p+"img/logo.b66a6118.svg";const a=(0,o.uE)('<header class="header"><div class="flex"><div class="logo"><img alt="Vue logo" src="'+i+'"></div><div class="title">Company title</div></div></header>',1),l={class:"main container py-1"},s=(0,o._)("footer",{class:"footer"},[(0,o._)("div",{class:"p-1"}," © 2023 All rights reserved ")],-1);function u(e,n,t,r,i,u){const c=(0,o.up)("Post");return(0,o.wg)(),(0,o.iD)(o.HY,null,[a,(0,o._)("main",l,[(0,o.Wm)(c,null,{default:(0,o.w5)((()=>[(0,o.Uk)(" Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ")])),_:1})]),s],64)}const c=e=>((0,o.dD)("data-v-4148919c"),e=e(),(0,o.Cn)(),e),m={class:"post"},d=c((()=>(0,o._)("h1",null,"Lorum Ipsum",-1)));function p(e,n,t,r,i,a){const l=(0,o.up)("comment-list");return(0,o.wg)(),(0,o.iD)(o.HY,null,[(0,o._)("div",m,[d,(0,o.WI)(e.$slots,"default",{},void 0,!0)]),(0,o.Wm)(l)],64)}const v={class:"commentList"};function f(e,n,t,r,i,a){const l=(0,o.up)("comment-add-form"),s=(0,o.up)("comment");return(0,o.wg)(),(0,o.iD)(o.HY,null,[(0,o.Wm)(l,{onEventCommentAdded:a.loadComments},null,8,["onEventCommentAdded"]),(0,o._)("ul",v,[((0,o.wg)(!0),(0,o.iD)(o.HY,null,(0,o.Ko)(e.commentList,((e,n)=>((0,o.wg)(),(0,o.j4)(s,{key:n,info:e},null,8,["info"])))),128))])],64)}var h=t(6943),_=t(7139);const g=e=>((0,o.dD)("data-v-3fad0d5a"),e=e(),(0,o.Cn)(),e),b={class:"comment"},w=g((()=>(0,o._)("br",null,null,-1))),C=g((()=>(0,o._)("br",null,null,-1))),y=["href"];function F(e,n,t,r,i,a){return(0,o.wg)(),(0,o.iD)("li",b,[(0,o._)("small",null,(0,_.zw)(t.info.created_at),1),w,(0,o._)("b",null,(0,_.zw)(t.info.title),1),C,(0,o.Uk)((0,_.zw)(t.info.content)+" ",1),(0,o._)("a",{class:"authorCommentInfo",href:"mailto:"+t.info.email},(0,_.zw)(t.info.user_name),9,y)])}var E={name:"Comment",props:{info:Object}},q=t(89);const D=(0,q.Z)(E,[["render",F],["__scopeId","data-v-3fad0d5a"]]);var O=D;const x=e=>((0,o.dD)("data-v-24c124b5"),e=e(),(0,o.Cn)(),e),L=["innerHTML"],k=x((()=>(0,o._)("div",{class:"line"},[(0,o._)("b",null,"Введите ваше сообщение:")],-1))),I={class:"line"},j={class:"line"},A={class:"line"},H={class:"line"},U=x((()=>(0,o._)("div",{class:"line"},[(0,o._)("input",{type:"submit"})],-1)));function Z(e,n,t,i,a,l){return(0,o.wg)(),(0,o.iD)(o.HY,null,[e.serverError?((0,o.wg)(),(0,o.iD)("div",{key:0,class:"errors",innerHTML:e.serverError},null,8,L)):(0,o.kq)("",!0),(0,o._)("form",{class:"commentAddForm",onSubmit:n[8]||(n[8]=(...e)=>l.sendCommentForm&&l.sendCommentForm(...e)),ref:"commentForm"},[k,(0,o._)("div",I,[(0,o.wy)((0,o._)("input",{class:"input",type:"text","onUpdate:modelValue":n[0]||(n[0]=n=>e.userName=n),placeholder:"Введите ваше имя",required:"required",onInvalid:n[1]||(n[1]=(...e)=>l.invalidateForm&&l.invalidateForm(...e))},null,544),[[r.nr,e.userName]])]),(0,o._)("div",j,[(0,o.wy)((0,o._)("input",{class:"input",type:"email","onUpdate:modelValue":n[2]||(n[2]=n=>e.userEmail=n),placeholder:"Введите ваш E-mail",required:"required",onInvalid:n[3]||(n[3]=(...e)=>l.invalidateForm&&l.invalidateForm(...e))},null,544),[[r.nr,e.userEmail]])]),(0,o._)("div",A,[(0,o.wy)((0,o._)("input",{class:"input",type:"text","onUpdate:modelValue":n[4]||(n[4]=n=>e.title=n),placeholder:"Введите тему сообщения",required:"required",onInvalid:n[5]||(n[5]=(...e)=>l.invalidateForm&&l.invalidateForm(...e))},null,544),[[r.nr,e.title]])]),(0,o._)("div",H,[(0,o.wy)((0,o._)("textarea",{class:"input","onUpdate:modelValue":n[6]||(n[6]=n=>e.content=n),placeholder:"Введите текст сообщения",required:"required",onInvalid:n[7]||(n[7]=(...e)=>l.invalidateForm&&l.invalidateForm(...e))},null,544),[[r.nr,e.content]])]),U],544)],64)}var N={name:"CommentAddForm",data:function(){return{serverErrorStatus:!1,serverError:"",userName:"",userEmail:"",title:"",content:"",errors:!1}},methods:{invalidateForm(){this.errors=!0},sendCommentForm(e){e.preventDefault();const n={userName:this.userName,userEmail:this.userEmail,title:this.title,content:this.content},t=this;return h.Z.post("http://api.spa.local:3180/api/v1/post/comment/add",n).then((function(e){t.$emit("event-comment-added",e.data),t.clearForm()})).catch((function(e){t.serverErrorStatus=!0,t.serverError=e.response.data.error})),!1},clearForm(){this.$refs.commentForm.reset()}}};const P=(0,q.Z)(N,[["render",Z],["__scopeId","data-v-24c124b5"]]);var V=P,Y={name:"CommentList",components:{Comment:O,CommentAddForm:V},data:function(){return{commentList:[]}},mounted(){this.loadComments()},methods:{loadComments(){var e=this;h.Z.get("http://api.spa.local:3180/api/v1/post/comments").then((function(n){e.commentList=n.data})).catch((function(){console.log("Loading error")}))}}};const z=(0,q.Z)(Y,[["render",f]]);var T=z,W={name:"Post",components:{CommentList:T}};const M=(0,q.Z)(W,[["render",p],["__scopeId","data-v-4148919c"]]);var S=M,$={name:"App",components:{Post:S}};const K=(0,q.Z)($,[["render",u]]);var B=K;(0,r.ri)(B).mount("#app")}},n={};function t(r){var o=n[r];if(void 0!==o)return o.exports;var i=n[r]={exports:{}};return e[r](i,i.exports,t),i.exports}t.m=e,function(){var e=[];t.O=function(n,r,o,i){if(!r){var a=1/0;for(c=0;c<e.length;c++){r=e[c][0],o=e[c][1],i=e[c][2];for(var l=!0,s=0;s<r.length;s++)(!1&i||a>=i)&&Object.keys(t.O).every((function(e){return t.O[e](r[s])}))?r.splice(s--,1):(l=!1,i<a&&(a=i));if(l){e.splice(c--,1);var u=o();void 0!==u&&(n=u)}}return n}i=i||0;for(var c=e.length;c>0&&e[c-1][2]>i;c--)e[c]=e[c-1];e[c]=[r,o,i]}}(),function(){t.n=function(e){var n=e&&e.__esModule?function(){return e["default"]}:function(){return e};return t.d(n,{a:n}),n}}(),function(){t.d=function(e,n){for(var r in n)t.o(n,r)&&!t.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:n[r]})}}(),function(){t.g=function(){if("object"===typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"===typeof window)return window}}()}(),function(){t.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)}}(),function(){t.p="/"}(),function(){var e={143:0};t.O.j=function(n){return 0===e[n]};var n=function(n,r){var o,i,a=r[0],l=r[1],s=r[2],u=0;if(a.some((function(n){return 0!==e[n]}))){for(o in l)t.o(l,o)&&(t.m[o]=l[o]);if(s)var c=s(t)}for(n&&n(r);u<a.length;u++)i=a[u],t.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return t.O(c)},r=self["webpackChunkspa"]=self["webpackChunkspa"]||[];r.forEach(n.bind(null,0)),r.push=n.bind(null,r.push.bind(r))}();var r=t.O(void 0,[998],(function(){return t(2969)}));r=t.O(r)})();
//# sourceMappingURL=app.f7bb39f6.js.map