import tatiyeNet,{
  setModal,
  setFrom,
  setHttp,
  Router,
  Images,
  modalRoute
} from "../../modules/tatiyeNet.js";
import {BASE_URL,BASE_API} from "../../modules/tatiyeNetConfig.js";
// https://v2.vuejs.org/v2/guide/installation
import Vue from 'https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.esm.browser.js';
import 'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js';



    const buttonClickHandler = event => {
      setModal({
       'titel':'Header Sidang',
       'width':'500px',
       'key':event.target.dataset.key,
       'model':'modalBody',
       'route':'demo/modal',
       'content':'from',
      });
    };

   const button = document.querySelector('#mysetmodal');
   button.addEventListener('click', buttonClickHandler);



// let imgsize=Images('80x80/profil/1/WFJS-01.png');
// console.log(imgsize)

// let imgori=Images('profil/1/WFJS-01.png');
// console.log(imgori)

window.app = new Vue({
  el: '#app',
  data: {
     "content"     :[],
     "indexOn"     :'Hello Net',  
     "token"       :'',    
     "select"      :"title,nama,date,time,userid",                
     "where"       :"row='1'",
     "limit"       :"3",
     "search"      :'',
     "page"        :1,
     "keywords"    :"",                  
     "news"        :[], 
     "pagingList"  :[],
     "Newer"       :1,
     "Older"       :1,
     "images"       :'',
     "userid"      :tatiyeNet.userid,
    },
    mounted (){
        this.storage()
    },
    methods: {
      // 8/24/2023 1:17:03 AM
     setImages(id){
        this.images =Images(id,'2023');
      },
      getPaging(count) {
       this.page =count;
      },
      dataUser(count) {
       this.page =count;
      },
      setUpdate(id,header){
          setModal({
           'titel':header,
           'width':'500px',
           'key'  :id,
           'model':'modalBody',
           'route':'demo/modal',
           'content':'from',
          });
      },
      // 8/24/2023 3:45:05 PM 
      modalRoute(header,id,style,content,path){
         modalRoute(header,id,style,content,path,'demo');
      },
      setDelete(id,header,uid){
          setModal({
           'titel':header,
           'width':'500px',
           'key'  :id,
           'model':'modalBody',
           'route':'demo/modal',
           'tabel':'demo',
           'content':'delete',
          });
      },
      setUpload(id,header,uid){
          setModal({
           'titel':header,
           'width':'500px',
           'key'  :id,
           'model':'modalBody',
           'route':'demo/upload',
           'tabel':'demo',
           'content':'upload',
          });
      },
      setUploadFile(id,header,uid){
          setModal({
           'titel':header,
           'width':'500px',
           'key'  :id,
           'model':'modalBody',
           'route':'demo/uploadFile',
           'tabel':'demo',
           'content':'upload',
          });
      }, 
      storage(){
       var vm = this; 
       axios.post(tatiyeNet.api+'/v1/select/devices/demo', {
           "select"  :this.select,
           "where"   :this.where,
           "limit"   :this.limit,
           "page"    :this.page,
           "keywords":this.keywords
       }, {
        headers: {
         'Content-Type': 'application/json',
         "Authorization": tatiyeNet.token,
        }
      })
      .then(function (response) {
        vm.content     = response.data.storage
        vm.pagingList  = response.data.paging
        vm.Newer  = response.data.newer
        vm.Older  = response.data.older
      });
      }
    },
  computed: {
    autoload(){
       return this.content;
    },
    setPaging(){
      return this.pagingList;
    },
    setNewer(){
      return this.Newer;
    },
    setOlder(){
      return this.Older;
    },
    setOlder(){
      return this.Older;
    },
   }
})

