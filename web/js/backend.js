let project = { modules: [] };

project.extend = function(moduleName, moduleData) {
    if (!moduleName) {
        return;
    }
    if (!moduleData) {
        let moduleData = {
            elements: {},
            init: () => {
                //console.log("Empty init for module");
            }
        };
    }
    this[moduleName] = moduleData;
    this.modules.push(moduleData);
    return moduleData;
};

project.init = function() {
    let totalModules = project.modules.length;
    for (let k = 0; k < totalModules; k++) {
        project.modules[k].init();
    }
};

project.extend("common", {
    init: function() {
        let self = this;

        $('.number').inputmask('Regex', {regex: "^[0-9]{1,4}$"});
        $('.decimal').inputmask('Regex', {regex: "^[0-9]{1,4}(\\.\\d{1,2})?$"});
        $('.phone').inputmask({"mask":"9999999999"});
    }

});

$(project.init);
