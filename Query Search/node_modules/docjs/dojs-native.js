/* Module dependcies. */
var program = require('commander'),
  fs = require('fs'),
  path = require('path');

/* Program variables. */
var Dojs = {}, 
  bar = '',
  folderStructure = {}
  appStructure = {};


/** 
 * Module to manage the dojs documentor functionality. The module help to generate documentation
 * for different javascript framework like backbonejs and angular js. also provide support for 
 * single javascript files. enhaced version to provide support of the markdown. currently the 
 * module support parsing throught the folder struture provide by the yeoman building library.
 * @module Dojs
 */
Dojs = {

  /* Variable to track the path of the project folder. */
  path : '',

  /**
   * Method to initialize the dojs library. 
   * @method initialize
   * @access public
   */
  initialize : function() {
    this.path = process.cwd();
  },

  /**
   * Method to create the documentation folder in the project folder.
   * @method _createDirectory
   * @access private
   */
  _createDocDirectory : function(appType)  {
    var folders = [],
      docPath = path.join(this.path,'doc');

    if(!path.existsSync(docPath))  {
      fs.mkdirSync(docPath);
    }
  },

  /**
   * Process file to get the comment blocks.
   * @method _processFile
   * @access private
   * @param string fileName
   */
  _processFile : function(fileName)  {
    var file = '', blocks = '';

    file = fs.readFileSync(fileName).toString().replace(/\n|\t/g, '');
    blocks = file.match(/\/[\*]{2}(\s|\*|[a-zA-Z0-9]|\.|\@|\_|\||\(|\)|\,|\$|\#|\%|\^|\&|\*|\[|\]|\'|\"|\:|\;|\,|\.|\<|\>|\?|\+|\=|\_|\-|\`|\~|\!|\/)+\*\//g);    

    if(blocks != null && blocks.length > 0) {
      var commentObject = [];

      for(var j = 0; j< blocks.length; j++)  {
        commentObject.push(this._prepareCommentBlock(blocks[j]));
      }

      this._preapreMarkDown(commentObject, fileName);
    }
  },

  _preapreMarkDown : function(commentObject, fileName) {
    var mdString = '###' + fileName + '\n';

    mdString += '____ \n';

    fileName = 'doc/' + fileName.replace('.js','.md');

    commentObject.forEach(function(comment) {
      mdString += '####' + ((comment.method !== '') ? comment.method : comment.module) + '\n';
      
      mdString += comment.comment + '\n';

      if(comment.namespace !== '')  {
        mdString += '- namespace : `' + comment.namespace +'` \n';
      }
      
      if(comment.access !== '') {
        mdString += '- access : `' + comment.access +'` \n';
      }

      if(comment.param.length !== 0)  {
        comment.param.forEach(function(attr)  {
          mdString += '- param : `' + attr[0] +'` `' +attr[1] + '` \n';  
        });
      }

      if(comment.return_ !== '')  {
        mdString += '- return : `' + comment.return_ +'` \n\n';
      }
      
    });

    mdString += "____";
    mdString += "_Document Generate Using Dojs 0.0.1 - github.com/jaisonjustus/dojs - Feel free to contribute!!_";
    mdString += "____";
    fs.writeFileSync(fileName, mdString);
  },

  /**
   * Method to prepare the comment object from the comment block extracted
   * from the javascript files.
   * @method _prepareComemntBlock
   * @access private
   */ 
  _prepareCommentBlock : function(commentString)  {
    var commentBlockObj = {
      module : '',
      override : '',
      namespace : '',
      comment : '',
      method : '',
      access : '',
      param : [],
      return_ : ''
    };

    commentString = commentString.replace(/\/\*{2}\s\*/, '').replace(/\*\//, '');
    commentString = commentString.split('*');

    for(var i = 0; i < commentString.length; i++) {
      commentString[i] = commentString[i].replace(/^\s\s*/, '').replace(/\s\s*$/, '');

      if(commentString[i].match('@module'))  {
        commentBlockObj.module = commentString[i].replace('@module','').replace(/\s+/, '')
      }else if(commentString[i].match('@override')){
        commentBlockObj.override = 'true';
      }else if(commentString[i].match('@namespace')) {
        commentBlockObj.namespace = commentString[i].replace('@namespace','').replace(/\s+/, '');
      }else if(commentString[i].match('@method')) {
        commentBlockObj.method = commentString[i].replace('@method','').replace(/\s+/, '');
      }else if(commentString[i].match('@access')) {
        commentBlockObj.access = commentString[i].replace('@access','').replace(/\s+/, '');
      }else if(commentString[i].match('@param')) {
        commentBlockObj.param.push(commentString[i].replace('@param ','').split(' '));
      }else if(commentString[i].match('@return')) {
        commentBlockObj.return_ = commentString[i].replace('@return','').replace(/\s+/, '');
      }else {
        commentBlockObj.comment += commentString[i] + ' ';
      }
    }

    return commentBlockObj;
  },


  _removeNonJSFiles : function(fileList)  {
    var temp = [];

    fileList.forEach(function(file) {
      if(file.match(/\.js$/) && file !== "dojs-native.js") {
        temp.push(file);
      }
    }, this);

    return temp;
  },

  /**
   * Method to walk through the directory structure.
   * @method _dirWalk
   * @access private
   */
  _dirWalk : function(directory, callback) {
    var fileList = [];

    fileList = fs.readdirSync(directory);
    fileList = this._removeNonJSFiles(fileList);

    return fileList;
  },

  /**
   * Method to run the comment grabber.
   * @method run
   * @access public
   */
  run : function()  {
    var that = this,
        categoryList = {},
        fileCount = 0, 
        fileList = [];

    this._createDocDirectory();

    fileList = this._dirWalk(path.join(this.path));

    if(fileList.length > 0) {
      fileList.forEach(function(file) {
        this._processFile(file);
      }, this);
    }

    process.exit();
  }
};

program
  .version('0.0.1')
  .option('-g, --generate [value]', 'Generate JS Documentation')
  .parse(process.argv);

if(program.generate)  {
  console.log('\n DOJS Documentation Generate **')
  Dojs.initialize(program.generate);
  Dojs.run();
};

process.on('exit', function(){
  console.log('\n');
});