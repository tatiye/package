import tatiyeNet,{setModal,setFrom,setHttp,Router} from "../../modules/tatiyeNet.js";
import {BASE_URL,BASE_API} from "../../modules/tatiyeNetConfig.js";
// https://v2.vuejs.org/v2/guide/installation
import Vue from 'https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.esm.browser.js';
import 'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js';



    const buttonClickHandler = event => {
      setModal({
       'titel':'Header Modal',
       'width':'500px',
       'key':event.target.dataset.key,
       'model':'modalBody',
       'route':'demo/modal',
       'content':'fromAction',
      });
    };
   const button = document.querySelector('#mysetmodal');
   button.addEventListener('click', buttonClickHandler);
 
window.app = new Vue({
  el: '#app',
  data: {
     "content"     :[],
     "indexOn"     :'Hello Net',  
     "token"       :'eyJ0b2tlbiI6MywidWlkIjoiMSJ9',    
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
     "userid"      :tatiyeNet.userid,
    },
    mounted (){
        this.storage()
    },
    methods: {
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
           'content':'fromAction',
          });
      },
      setDelete(id,header,uid){
          setModal({
           'titel':header,
           'width':'500px',
           'key'  :id,
           'model':'modalBody',
           'route':'demo/modal',
           'tabel':'demo',
           'content':'fromDelete',
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
           'content':'fromUpload',
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
           'content':'fromUploadFile',
          });
      },

      
      storage(){
       var vm = this; 
       axios.post(tatiyeNet.api+'/v1/react/select/demo', {
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

   }
})

