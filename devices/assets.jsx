  import tatiyeNet,{components,createRouter} from "{tatiye.es6}"; 
console.log(tatiyeNet)
    const app = new components();
   app.dropdown({
      "app":"app-tatiye",
      "element":"dropdown",
      "onclick"  :"useClick",
      "lengthMenu"  :{
          "Detail"          :["modal",       'nama'  ,"info"   ,'' ],
          "Route"           :["route",        'nama'  ,"info"   ,"demo/lorem" ],
          "Update"          :["from",         'nama'  ,"edit-3" ,'' ],
          "Upload Images"   :["upload",       'nama'  ,"image"  ,'' ],
          "Upload Doc"      :["uploadFile",   'nama'  ,"file"   ,'' ],
          "Recycle"         :["recycle",      'nama'  ,"trash"  ,'' ],
          "Delete"          :["delete",       'nama'  ,"trash"  ,'newToken' ],
        }
   })

