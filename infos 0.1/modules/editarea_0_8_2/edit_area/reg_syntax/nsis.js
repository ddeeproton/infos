editAreaLoader.load_syntax["nsis"] = {
	'DISPLAY_NAME' : 'Nsis'
	,'COMMENT_SINGLE' : {1 : ';', 2 : '#'}
	,'COMMENT_MULTI' : {'/*' : '*/'}
	,'QUOTEMARKS' : {1: "'", 2: '"'}
	,'KEYWORD_CASE_SENSITIVE' : false
	,'KEYWORDS' : {
		'statements' : [
			'Section', 'Function', 'SectionEnd', 'FunctionEnd'
		]
		,'reserved' : [
			'INSTDIR', 'CMDLINE'
			
		]
		,'functions' : [
			'insertmacro', 'define', 'Call', 'Pop', 'setCompressor', 'else',
      'OutFile', 'BrandingText', 'XPStyle', 'File', 'FileWrite', 'Delete', 
      'RMDir'
		]
	}
	,'OPERATORS' :[
		':'
	]
	,'DELIMITERS' :[
		'(', ')', '[', ']', '{', '}'
	]
	,'STYLES' : {
		'COMMENTS': 'color: #AAAAAA;'
		,'QUOTESMARKS': 'color: #879EFA;'
		,'KEYWORDS' : {
			'reserved' : 'color: #48BDDF;'
			,'functions' : 'color: #0040FD;'
			,'statements' : 'color: #60CA00;'
			}
		,'OPERATORS' : 'color: #FF00FF;'
		,'DELIMITERS' : 'color: #2B60FF;'
		,'REGEXPS' : {
			'variables' : 'color: #E0BD54;'
		}		
	}
	
};
