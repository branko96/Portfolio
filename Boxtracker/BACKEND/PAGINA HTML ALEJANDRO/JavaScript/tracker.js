// v6.3.1695
(function(h,l,J,z,K,s,r,u,ba,ca,da,x,Q,A,ea,v,fa,ga){function qa(a,b){return function(){a.call(b)}}function B(a){return"object"==typeof a}function ra(){for(var a=32,b="";a--;)b+=(0|16*K.random()).toString(16);return b}function w(a,b,c,d){var e;(e=a.addEventListener)?e.call(a,b,c,0):a.attachEvent(d||"on"+b,c)}function n(a,b,c){return function(){a(b,c)}}function y(a,b){for(var c in a)a.hasOwnProperty(c)&&a[c]!==m&&b(a[c],c)}function L(a,b){var c=[],d;y(a,function(a,f){d=(typeof a).charAt(0);c.push(ba(f)+
"="+ba(b?d+("o"==d&&a?L(a,b):a):a))});return c.join("&")}function C(a,b){if(!a)throw Error(b);}function sa(a){var b={};y(a,function(a,d){b[d]=a});return b}function ta(a){var b="_"+ua++;M[b]=a;return b}function ha(){var a=h.olark;a&&a("api.boot.onIdentityReady",function(a,c,d){D=a;R=c;S=d})}function N(a,b){function c(a){return"expires="+(new s(a)).toGMTString()+";"}var d="path=/;",e=a.g(6);e&&(d+="domain="+e+";");return{p:function(e,p){a.g(1,1)&&(l.cookie=e+"="+p+";"+c(+new s+(b?6E10:6E4))+d)},n:function(b){if(a.g(1,
1))return(l.cookie.match("(^|;)\\s*"+b+"=([^;]*)")||[])[2]||m},G:function(a){l.cookie=a+"=;"+c(0)+d}}}function E(a){function b(){var a=d[v];a&&(d[v]=a[x](":_GS_:")[0])}var c;if(E[a])return E[a];var d=h.top;E[a]=c={R:function(){b();d[v]=(d[v]||"")+":_GS_:"+[a,c.c,c.A]}};try{var e=d[v]||"";if(-1!=e[ga](":_GS_:")){var f=e[x](":_GS_:")[1][x](",");f[0]==a&&(c.c=f[1]||"",c.A=f[2]||"")}b()}catch(p){d={}}return c}function T(a){function b(){f.p(d,p.c=[U,548*g.r+2019,379*g.o+4621,+new s].join(":"));a.s(11,
U)}function c(){h&&"-"!==h?f.p(e,h):f.G(e)}var d="gs_u_"+a.b,e="gs_v_"+a.b,f=N(a,1),p=E(a.b),k=(f.n(d)||p.c||"")[x](":"),ia=1,U=a.g(11,k[0])||(ia=0,ra()),va=((k[1]||2019)-2019)/548,l=((k[2]||4621)-4621)/379,k=(k[3]||0)/1E3,h=a.g(13),g;g={c:U,N:h,r:va,o:l,X:~~k,ca:ia,T:function(a,c){g.o+=+a;g.r+=+c;b()},da:function(a){h=g.N=a;c()},ia:b,aa:function(){var b=f.n("gs_p_"+a.b)||p.A;f.G("gs_p_"+a.b);return a.i!==m?a.i:b}};h&&c();return g}function wa(a){var b=l[fa]("head")[0],c=l[da]("script");c.src=(xa?
"https":"http")+"://"+V[W]+a;b.appendChild(c);return function(){c&&b.removeChild(c);c=null}}function O(a,b,c,d,e){var f=n,p=r(function(){f();W=(W+1)%V[A];c.et&&(c.et=0);c.rt=1;--e&&O(a,b,c,d,e)},1E4),k=T(a);c.cb=ta(function(a){d(a);f();u(p)});c.a=a.b;c.au=a.g(14);c.id=k.c;c.cid=k.N;c.tv=ca;k=b+"?"+L(c);ja?ja.ha(k):f=wa(k)}function ka(a){var b;a.D?(b=L(a.f,1))&&O(a,"prop",{cp:b},n,5):r(function(){ka(a)},100)}function la(a,b,c){var d=a.f=a.f||{};C(b||B(c),"Not an object");b?d[b]=c:d=a.f=c;!a.L&&a.D&&
(a.L=r(function(){ka(a);a.L=0},100))}function ya(){var a=0,b=0,c;z&&(a=z.width,b=z.height);c=(c=h.orientation)&&(c+360)%180;return{C:c?b:a,B:c?a:b,P:z&&z.colorDepth||"-",W:J.language||J.browserLanguage||"-",Q:l.characterSet||l.charSet||"-",S:h.devicePixelRatio||1,Y:(new s).getTimezoneOffset()}}function X(){function a(a){return h["inner"+a]||c&&c[e="client"+a]||d&&d[e]}function b(a){return K.max(d[e="scroll"+a]|0,c[e]|0,d[e="offset"+a]|0,c[e]|0,d[e="client"+a]|0,c[e]|0)}var c=l.documentElement,d=l.body||
c,e;return{O:a("Width"),M:a("Height"),I:b("Width"),H:b("Height"),k:h.pageXOffset||c&&c.scrollLeft||0,l:h.pageYOffset||c&&c.scrollTop||0}}function ma(a){a.h&&(a.h=0,a.m=new s-a.t+(a.m||0))}function Y(a){u(a.Z);a.Z=r(n(ma,a),15E3);a.h||(a.h=1,a.t=new s)}function za(a){var b=a.m,c=new s;a.h&&(b+=c-a.t,a.t=c);a.m=0;return b}function Aa(a){Y(a);var b=X();b.l>a.w&&(a.w=b.l);b.k>a.u&&(a.u=b.k)}function Ba(a){var b=n(Y,a);w(l,"mousemove",b);w(l,"keydown",b);w(h,"scroll",n(Aa,a));w(l,"focus",b,"focusin");
w(l,"blur",n(ma,a),"focusout")}function Ca(a){a=a.g(10,l.referrer);var b;!a||/^(chrome|about|file):/.test(a)||/^\[.*\]$/.test(a)?a="-":b=a[Q](/^.*?\/\//,"")[ga](location.host);return{J:+(0<=b&&8>=b),ba:a}}function Da(a,b,c){var d=l[da]("a");d.href=b||h.location.href;b=d.href;a.g(7,1)||(b=b[Q](/\?[^#]*/,""));a.g(8)||(b=b[Q](/#.*$/,""));return{ga:b,ea:c!==m?c:l.title,V:/^file:/.test(b)||/\/\/localhost[\/:]/.test(b+"/"),U:/fb_xd_(bust|fragment)/.test(b)}}function P(a,b,c,d){if(a.i!==m){if(!c){var e=
X();c={vw:e.O,vh:e.M,dw:e.I,dh:e.H,st:e.l,sl:e.k,mst:a.w,msl:a.u}}c.i=a.i;c.e=b;c.et=za(a);q&&(c.bc=1);a.K&&D&&(a.K=0,c.o_si=D,c.o_vi=R,c.o_ci=S);O(a,"ping",c,function(){d&&d();u(a.j);a.j=r(n(P,a),[7E3,12E3][a.$++]||17500+5E3*K.random())},5)}else r(function(){P(a,b,c,d)},5E3)}function Ea(a){if(a.i!==m){var b=N(a);a.g(1,1)?b.p("gs_p_"+a.b,a.i):(b=E(a.b),b.A=a.i,b.R())}}function Z(a,b,c){C(a,"Event name is required");b&&b.call&&(c=b,b=m);if(b===""+b||b===+b)b={caption:b};b=sa(b||{});b.gs_evt_name=a;
P(this,"event",b,c)}function $(a,b,c){a&&a.call&&(c=a,a=m);b&&b.call&&(c=b,b=m);var d=this,e=Da(d,a,b),f=Ca(d),p=d.i===m&&!f.J;b=d.D=T(d);var k=ya(),g=X(),l=d.g(5);b.T(1,p);u(d.j);d.m=0;d.h=0;Y(d);!d.g(9)&&e.V||e.U||J&&"preview"==J.loadPurpose||k.C&&k.B&&10>k.C&&10>k.B||(d.w=g.l,d.u=g.k,e={cs:k.Q,cd:k.P,la:k.W,sw:k.C,sh:k.B,dp:k.S,pu:e.ga,pt:e.ea||"-",ri:f.J,ru:f.ba,re:b.ca,vi:b.r,pv:b.o,lv:b.X,vw:g.O,vh:g.M,dw:g.I,dh:g.H,st:g.l,sl:g.k,un:d.g(3),pp:b.aa(),ec:l,aip:d.g(2)?1:m,tz:k.Y},d.f&&(e.cp=L(d.f,
1)),q&&(d.uid=b.c,e.bc=1),D?(e.o_si=D,e.o_vi=R,e.o_ci=S):d.K=1,d.$=0,O(d,"pv",e,function(a){a!==m&&(d.i=a,u(d.j),d.j=r(n(P,d),5E3),c&&c())},5),d.i!==m?a!==m&&(d.i=m):(r(n(Ba,d),500),w(h,"beforeunload",n(Ea,d))))}function na(a){var b="gs_v_"+a,c=this,d=[];d[12]=c.b=a;c.s=function(a,b,e){4==a&&(la(c,e,b),b=c.f);13==a&&(la(c,"id",b),b=b||"-",T(c).da(b));d[a]=b};c.g=function(a,e){return a in d?d[a]:13==a?N(c,1).n(b)||e:e};var e;c.fa=function(){e=r(qa($,c),200)};c.F=function(){u(c.j);u(e)}}function aa(a,
b,c){if(!a)for(a in g)return g[a];if(g[b||a])return g[b||a];a=g[b||a]=new na(a);c&&a.fa();return a}function F(a,b,c,d,e){b?a.call(g[b],c,d,e):y(g,function(b){a.call(b,c,d,e)})}function Fa(a,b,c,d){function e(a,b){b=b||(B(a)?a:{});B(a)||(b[v]=a);C(b[v],"No Name");k.push(b);return h}function f(a){for(var b=0;b<a[A];)e(a[b++]);return h}function g(){F(function(){var a=N(this,1),d="gs_t_"+this.b,e=a.n(d)||0;a.p(d,+new s);Z.call(this,"_transaction",{d:JSON.stringify({id:b,pt:{ts:+e},i:k,d:c})})},a)}!c&&
B(b)&&(c=b,b=c.id);C(b,"No ID");var k=[],h;d&&f(d);c&&c.track&&g();return h={id:b,addItem:e,addItems:f,track:g}}function Ga(a,b){!b&&B(a)&&(b=a,a=b.id,!a&&b.email&&(a="email:"+b.email));C(a,"ID or email required");this.s(13,a);b&&this.s(4,b)}function G(a,b,c,d){if(a&&a.call)a();else if(/^GSN-.*-.$/.test(a))b!==""+b&&(c=b,b=0),aa(a,b,c||c===m);else if(/^_/.test(a))M[a]&&M[a](b,c),delete M[a];else{var e=function(a,b,c){f?g[f].s(a,b,c):y(g,function(d){d.s(a,b,c)})};a=a[x](".");var f;1<a[A]&&(f=a.shift());
a=a[0];var h={usecookies:1,anonymizeip:2,visitorname:3,username:3,statuscode:5,cookiedomain:6,trackparams:7,trackhash:8,tracklocal:9,referrer:10,visitorid:13,visitor:4,clientid:11,auth:14,props:4,properties:4};if(/transaction$/i.test(a))return Fa(f,b,c,d);if("get"==a)return c=h[(b+"")[ea]()]||b,f?d=g[f].g(c):y(g,function(a){d=a.g(c)}),d;"set"==a?(a=(b+"")[x]("."),b=a.shift(),e(h[b[ea]()]||b,c,a.join("."))):"track"==a?F($,f,b,c,d):"event"==a?F(Z,f,b,c,d):"cancel"==a?F(function(){this.F()},f):"noCookies"==
a?e(1,0):"anonymizeIP"==a?e(2,1):"tag"==a?e(3,b):"load"==a?b&&b():"auth"==a?e(14,b):"identify"==a?F(Ga,f,b,c,d):"alias"==a?e(13,b):"unidentify"==a?e(13):"props"!=a&&"properties"!=a||e(4,b)}}var m,H,I=h._gs||(H=1,function(){oa.push(arguments)}),oa=I.q=I.q||[];if(!I.v){var q=h.GoSquared,M={},ua=0,D,R,S,ja,V=["data.gosquared.com/","data2.gosquared.com/"],W=0|K.random()*V[A],xa=/^https:/.test(location.href),g={};if(q){y(q,function(a,b){"acct"==b?(aa(a,"_default",1),I(function(){function c(a){d[a.shift()].apply(d,
a)}var d=q.DefaultTracker=g._default;if(b=q.q)for(;a=b.shift();)c(a);q.q={push:c};(b=q.load)&&b(d)})):"load"!=b&&"q"!=b&&I("set",b,a)});var t=na.prototype;t.TrackView=$;t.TrackEvent=Z;t.Cancel=function(){this.F()};q.Tracker=aa;q.Cancel=n(G,"cancel")}h._gs=G;for(G.v=ca;t=oa.shift();)G.apply({},t);if(H){H=l[fa]("script");for(var t=H[A],pa;t--;)(pa=H[t].getAttribute("data-gs"))&&G(pa)}ha();w(h,"load",ha)}})(window,document,navigator||{},screen,Math,Date,setTimeout,clearTimeout,encodeURIComponent,"6.3.1695",
"createElement","split","replace","length","toLowerCase","name","getElementsByTagName","indexOf");