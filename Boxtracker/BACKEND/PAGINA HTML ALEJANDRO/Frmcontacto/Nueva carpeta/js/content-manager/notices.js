define(['js/content-manager/common'], function (common) {
    /**
    * This object contains all the API methods related to notices
    *
    * @module content-manager/notices
    * @class Notices
    */
    var api = {
        /**  
        * Gets a list of notices, from start, it will return limit results, ordered 
        *
        * @method GetNotices
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} [start=0] 0 by default, it will skil notices until start
        * @param {Integer} [limit=0] 0 to disable, if defined it will return a maximum of limit entries
        * @param {Boolean} [descending=false] Whether to sort the result ascending or descending, ascending by default
        */
        GetNotices: function (success, error, start, limit, descending) {
            var data = {
                start: start || 0,
                limit: limit || 0,
                descending: descending || false
            };
            common.ajax('POST', 'Contentmanager/WebServices/Noticias.asmx/GetNoticias', data, success, error);
        },

        /**  
        * Gets a single notice by id
        *
        * @method GetNoticeById
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the notice
        */
        GetNoticeById: function (success, error, id) {
            common.ajax('POST', 'Contentmanager/WebServices/Noticias.asmx/GetNoticiaById', { id: id }, success, error);
        },

        /**  
        * Gets a list of notices by section
        *
        * @method GetNoticesBySection
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the section
        * @param {Integer} [start=0] If set it will skip n entries from the list, where n = start
        * @param {Integer} [limit=0] If set it will limit the ammount of results to n, where n = limit
        * @param {Boolean} [descending=false] Whether to get the results in descending or ascending order, ascending by default
        */
        GetNoticesBySection: function (success, error, id, start, limit, descending) {
            var data = {
                cod: id,
                descending: descending || false,
                start: start || 0,
                limit: limit || 0
            };
            common.ajax('POST', 'Contentmanager/WebServices/Noticias.asmx/GetNoticiasBySeccion', data, success, error);
        },

        /**  
        * Gets a list of notices by subsection
        *
        * @method GetNoticesBySubsection
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the section
        * @param {Integer} [start=0] If set it will skip n entries from the list, where n = start
        * @param {Integer} [limit=0] If set it will limit the ammount of results to n, where n = limit
        * @param {Boolean} [descending=false] Whether to get the results in descending or ascending order, ascending by default
        */
        GetNoticesBySubsection: function (success, error, id, start, limit, descending) {
            var data = {
                cod: id,
                descending: descending || false,
                start: start || 0,
                limit: limit || 0
            };
            common.ajax('POST', 'Contentmanager/WebServices/Noticias.asmx/GetNoticiasBySubseccion', data, success, error);
        },

        /**  
        * Gets a list notices' sections.
        *
        * @method GetSections
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        */
        GetSections: function (success, error) {
            common.ajax('POST', 'Contentmanager/WebServices/Noticias.asmx/GetSecciones', {}, success, error);
        },

        /**  
        * Gets a list notices' subsections.
        *
        * @method GetSubsections
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        */
        GetSubsections: function (success, error) {
            common.ajax('POST', 'Contentmanager/WebServices/Noticias.asmx/GetSubsecciones', {}, success, error);
        },

        /**  
        * Gets a pdf url from a notice id, optionally it can be formatted as a newsletter mail
        *
        * @method GetPDFFromNotice
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the notice
        * @param {Boolean} [format=false] Whether or not to apply newsletter format to the mail, the default is false
        */
        GetPDFFromNotice: function (success, error, id, format) {
            var data = {
                id: id,
                formatAsNewsletter: format || false
            };
            common.ajax('POST', 'Contentmanager/WebServices/Noticias.asmx/GetPDFFromNoticia', data, success, error);
        },

        /**  
        * Gets a list of files associated with the notice
        *
        * @method GetFilesFromNotice
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the notice
        */
        GetFilesFromNotice: function (success, error, id) {
            common.ajax('POST', 'Contentmanager/WebServices/Noticias.asmx/GetFilesFromNoticia', { id: id }, success, error);
        }
    };

    return api;
});