define(['js/content-manager/common'], function (common) {
    /**
    * This object contains all the API methods related to notices images
    * Note that the images web services are deprecated and should be reimplemented (like the notice web service is)
    *
    * @module content-manager/notices-images
    * @class Images
    */
    var api = {
        /**  
        * Gets a list of all the images related to a notice
        *
        * @method GetImagesFromNotice
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the notice
        */
        GetImagesFromNotice: function (success, error, id) {
            var data = {
                IDNot: id
            };
            common.ajax('POST', 'Contentmanager/Gestor_Imagenes.asmx/ObtenerImagenesPorNoticia', data, success, error);
        },

        /**  
        * Removes an image from the notice, this methods requires logging in.
        *
        * @method RemoveImageFromNotice
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the image to delete
        */
        RemoveImageFromNotice: function (success, error, id) {
            var data = {
                IDFoto: id
            };
            common.ajax('POST', 'Contentmanager/Gestor_Imagenes.asmx/EliminarImgDeNoticia', data, success, error);
        },

        /**  
        * Sets the main image of the notice, this methods requires logging in.
        *
        * @method SetNoticeMainImage
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the notice
        * @param {String} image_url The path to the image itself
        */
        SetNoticeMainImage: function (success, error, id, image_url) {
            var data = {
                IDNot: id,
                nombreImg: image_url
            };
            common.ajax('POST', 'Contentmanager/Gestor_Imagenes.asmx/SetearImgPrincipal', data, success, error);
        },

        /**  
        * Sets the footnote of an image, this methods requires logging in.
        *
        * @method SetImageFootnote
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the image
        * @param {String} note The note
        */
        SetImageFootnote: function (success, error, id, note) {
            var data = {
                IDFoto: id,
                nota: note
            };
            common.ajax('POST', 'Contentmanager/Gestor_Imagenes.asmx/SetearNotaDePie', data, success, error);
        },

        /**  
        * Gets the main image of a notice
        *
        * @method GetNoticeMainImage
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the notice
        */
        GetNoticeMainImage: function (success, error, id) {
            var data = {
                IDNot: id
            };
            common.ajax('POST', 'Contentmanager/Gestor_Imagenes.asmx/getImgPrincipal', data, success, error);
        },

        /**  
        * Gets the footnote of an image
        *
        * @method GetImageFootnote
        * @param {Function} success A callback function if the call was successful
        * @param {Function} error A callback function if the call failed
        * @param {Integer} id The id of the image
        */
        GetImageFootnote: function (success, error, id) {
            var data = {
                IDFoto: id
            };
            common.ajax('POST', 'Contentmanager/Gestor_Imagenes.asmx/getNotaDePie', data, success, error);
        }
    };

    return api;
});