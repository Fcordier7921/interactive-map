<?php
return array (
  'A TLS/SSL is strongly favored in production environments to prevent passwords from be transmitted in clear text.' => 'Рекомендуется использовать TLS/SSL шифрование на реальных проектах, чтобы защититься от передачи паролей в открытом виде.',
  'Base DN' => 'База поиска (Base DN)',
  'Defines the filter to apply, when login is attempted. %s replaces the username in the login action. Example: &quot;(sAMAccountName=%s)&quot; or &quot;(uid=%s)&quot;' => 'Задает фильтр, который должен применяться при попытке входа. %s заменяет имя пользователя во время входа.<br>Пример: &quot;(sAMAccountName=%s)&quot; или &quot;(uid=%s)&quot;',
  'E-Mail Address Attribute' => 'Атрибут Email',
  'Enable LDAP Support' => 'Включить поддержку LDAP',
  'Encryption' => 'Шифрование',
  'Fetch/Update Users Automatically' => 'Выбор/Обновление пользователей автоматически',
  'Hostname' => 'Имя хоста',
  'ID Attribute' => 'ID Атрибут',
  'LDAP' => 'LDAP',
  'LDAP Attribute for E-Mail Address. Default: &quot;mail&quot;' => 'Атрибут LDAP для адреса электронной почты. По умолчанию: &quot;mail&quot;',
  'LDAP Attribute for Username. Example: &quot;uid&quot; or &quot;sAMAccountName&quot;' => 'Атрибут LDAP для имени пользователя.<br>Пример: &quot;uid&quot; или &quot;sAMAccountName&quot;',
  'Limit access to users meeting this criteria. Example: &quot;(objectClass=posixAccount)&quot; or &quot;(&(objectClass=person)(memberOf=CN=Workers,CN=Users,DC=myDomain,DC=com))&quot;' => 'Ограничить доступ пользователям, отвечающим этим условиям.<br>Пример: quot;(objectClass=posixAccount)&quot; или &quot;(&(objectClass=person)(memberOf=CN=Workers,CN=Users,DC=myDomain,DC=com))&quot;',
  'Login Filter' => 'Фильтр логинов',
  'Not changeable LDAP attribute to unambiguously identify the user in the directory. If empty the user will be determined automatically by e-mail address or username. Examples: objectguid (ActiveDirectory) or uidNumber (OpenLDAP)' => 'Неизменяемый атрибут LDAP для однозначной идентификации пользователя в каталоге. Если поле пусто, пользователь будет автоматически определяться по адресу электронной почты или имени пользователя.<br>Примеры: objectguid (ActiveDirectory) или uidNumber (OpenLDAP)',
  'Password' => 'Пароль',
  'Port' => 'Порт',
  'Specify your LDAP-backend used to fetch user accounts.' => 'Задайте настройки LDAP-сервера, который будет использоваться для извлечения учётных записей пользователей.',
  'Status: Error! (Message: {message})' => 'Статус: Ошибка! (Текст ошибки: {message})',
  'Status: OK! ({userCount} Users)' => 'Статус: OK! ({userCount} Пользователей)',
  'Status: Warning! (No users found using the ldap user filter!)' => 'Статус: Внимание! (Не найдено пользователей, с использованием LDAP фильтра!)',
  'The default base DN used for searching for accounts.' => 'По умолчанию База DN используется для поиска аккаунтов.',
  'The default credentials password (used only with username above).' => 'Пароль по умолчанию (используется только с именем пользователя, приведённом выше)',
  'The default credentials username. Some servers require that this be in DN form. This must be given in DN form if the LDAP server requires a DN to bind and binding should be possible with simple usernames.' => 'Имя пользователя по умолчанию. Некоторые сервера требуют, чтобы имя пользователя было в форме DN, поэтому если LDAP сервер требует это, имя должно быть приведено в надлежащем формате.',
  'User Filter' => 'Пользовательский файлер',
  'Username' => 'Имя пользователя',
  'Username Attribute' => 'Пользовательские данные',
);