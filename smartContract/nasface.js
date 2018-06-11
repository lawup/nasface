"use strict";

var FaceItem = function(text) {
	if (text) {
		var obj = JSON.parse(text);
		this.key = obj.key;
		this.value = obj.value;
		this.author = obj.author;
	} else {
	    this.key = "";
	    this.author = "";
	    this.value = "";
	}
};

FaceItem.prototype = {
	toString: function () {
		return JSON.stringify(this);
	}
};

var NasFaceMain = function () {
    LocalContractStorage.defineMapProperty(this, "repo", {
        parse: function (text) {
            return new FaceItem(text);
        },
        stringify: function (o) {
            return o.toString();
        }
    });
};

NasFaceMain.prototype = {
    init: function () {
        // todo
    },

    save: function (key, value) {

        key = key.trim();
        value = value.trim();
        if (key === "" || value === ""){
            throw new Error("empty key / value");
        }
        if (value.length > 64 || key.length > 64){
            throw new Error("key / value exceed limit length")
        }

        var from = Blockchain.transaction.from;
        var faceItem = this.repo.get(key);
        if (faceItem){
            throw new Error("value has been occupied");
        }

        faceItem = new FaceItem();  //区分大小写
        faceItem.author = from;
        faceItem.key = key;
        faceItem.value = value;

        this.repo.put(key, faceItem);
    },

    get: function (key) {
        key = key.trim();
        if ( key === "" ) {
            throw new Error("empty key")
        }
        return this.repo.get(key);
    }
};
module.exports = NasFaceMain;