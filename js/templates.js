angular.module('templates-main', ['views/credential.html', 'views/unlock.html', 'views/vault.html']);

angular.module('views/credential.html', []).run(['$templateCache', function($templateCache) {
  'use strict';
  $templateCache.put('views/credential.html',
    '<div class="row"><div class="col-12 col-md-6"><div class="form-group"><label for="label">Label</label><span style="color:red;text-weight:bold">*</span> <input class="form-control" id="label" name="label" type="text" ng-model="storedCredential.label"></div><div class="form-group"><label for="username">Username</label><input class="form-control" id="username" name="username" type="text" ng-model="storedCredential.username"></div><div class="form-group"><label for="email">E-Mail</label><input class="form-control" id="email" name="email" type="text" ng-model="storedCredential.email"></div><div class="form-group"><label for="url">URL</label><input class="form-control" id="url" name="url" type="text" ng-model="storedCredential.url"></div><div class="form-group"><label for="ip">IP</label><input class="form-control" id="ip" name="ip" type="text" ng-model="storedCredential.ip"></div><div class="form-group"><label for="password">Password</label><password-gen ng-model="storedCredential.password" settings="pwSettings"></password-gen><ng-password-meter password="storedCredential.password"></ng-password-meter></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="group">Group</label><select class="form-control" id="group" name="group" ng-model="storedCredential.group_id"><option ng-repeat="group in availableGroups" ng-value="{{group.group_id}}">{{group.name}}</option></select></div><div class="form-group"><label for="category">Category</label><select class="form-control" id="category" name="category" ng-model="storedCredential.category_id"><option ng-repeat="category in availableCategories" ng-value="{{category.category_id}}">{{category.name}}</option></select></div><div class="form-group"><label for="description">Description</label><textarea class="form-control" rows="6" id="description" name="description" ng-model="storedCredential.description"></textarea></div></div></div><div class="button-container"><button type="button" ng-click="saveCredential()" ng-disabled="saveProgress"><i class="fas fa-spinner fa-spin" ng-show="saveProgress"></i> Save</button> <button type="button" ng-click="cancel()">Cancel</button></div>');
}]);

angular.module('views/unlock.html', []).run(['$templateCache', function($templateCache) {
  'use strict';
  $templateCache.put('views/unlock.html',
    '<div id="spwm-unlockscreen"><div class="wrapper"><div class="container"><div class="circle"><div class="circle-inner"><i class="fas fa-lock" vault-lock-directive></i></div></div><div class="password-container"><div class="form-group"><div class="box"><label for="unlockPassword">Unlock your Vault</label></div><div class="box"><input type="password" name="unlockPassword" id="unlockPassword" class="form-control" ng-keyup="($event.keyCode == 13) ? unlockVault() : return" ng-model="password" autofocus> <button type="button" ng-click="unlockVault()"><i class="fas fa-unlock-alt"></i></button></div></div></div></div><div class="alert" ng-class="alert_type" ng-if="!alert_hidden"><p class="content">{{ alert_text }}</p><i class="fas fa-times btn-close" alt="Close" ng-click="setAlertHidden(true)"></i></div></div></div>');
}]);

angular.module('views/vault.html', []).run(['$templateCache', function($templateCache) {
  'use strict';
  $templateCache.put('views/vault.html',
    '<div id="controls"><div class="create"><button type="button" ng-click="addCredential()">+</button></div></div>');
}]);
