<?php
/**
 * Handles parsing of text (for future translations and control)
 *
 *
 * @package Well Organised WP Blog Theme
 */
function wobt_parse_text($text)
{
    return __($text, WOBT_THEME_SUFFIX);
}

function wobt_get_text($key)
{
    $t = [
        // header
        'header_search' => wobt_parse_text('Sök'),
        'header_menu' => wobt_parse_text('Meny'),
        // content
        'content_not_found' => wobt_parse_text('<strong>Ursäkta!</strong> Kunde inte hitta några poster (eller sidor) relaterade till'),
        // single
        'single_no_tags' => wobt_parse_text('Inga taggar'),
        'single_tags' => wobt_parse_text('taggar'),
        'single_tag' => wobt_parse_text('tag'),
        'single_likes' => wobt_parse_text('likes'),
        'single_like' => wobt_parse_text('gillar'),
        'single_comments' => wobt_parse_text('kommentarer'),
        'single_comment' => wobt_parse_text('kommentar'),
        'single_latest_update' => wobt_parse_text('Senast uppdaterad'),
        'single_under' => wobt_parse_text('Under'),
        'single_with' => wobt_parse_text('Med'),
        'single_read_more' => wobt_parse_text('Läs mer'),
        'single_read_more_posts' => wobt_parse_text('Läs fler inlägg'),
        'single_go_back' => wobt_parse_text('Tillbaka till bloggen'),
        'single_go_back2' => wobt_parse_text('Tillbaka'),
        /* translators: %s: Post author. */
        'single_published_by' => wobt_parse_text('Publicerad av %s'),
        'single_this_post' => wobt_parse_text('denna post'),
        'single_this_page' => wobt_parse_text('denna sida'),
        'single_next_post' => wobt_parse_text('Nästa inlägg'),
        'single_prev_post' => wobt_parse_text('Föregående'),
        'single_edit_post' => wobt_parse_text('Redigera'),
         // comments
        'comments_leave_reply' => wobt_parse_text('Lämna en kommentar'),
        'comments_log_out' => wobt_parse_text('Logga ut?'),
        'comments_logged_in_as' => wobt_parse_text('Du är inloggad som'),
        'comments_edit_profile' => wobt_parse_text('Redigera din profil'),
        'comments_publish_comment' => wobt_parse_text('Skicka kommentar'),
        'comments_commented' => wobt_parse_text('kommenterade'),
        'comments_replied' => wobt_parse_text('svarade'),
        'comments_reply' => wobt_parse_text('Svara'),
        'comments_reply_label' => wobt_parse_text('Svar på kommentar'),
        'comments_mandatory_fields' => wobt_parse_text('Obligatoriska fält är märkta med'),
        'comments_textarea_placeholder' => wobt_parse_text('Vad tycker du?'),
        'comments_missing_comments' => wobt_parse_text('Det finns ännu inga kommentarer - bli den första som skriver ett <a href="#respond">svar!</a>'),
        'comments_awaiting_approval' => wobt_parse_text('Tack för din kommentar! Kommentaren ses nu över för godkännande.'),
        'comments_thanks' => wobt_parse_text('Tack för din kommentar!'),
        'comments_like_thanks' => wobt_parse_text('Tack för att du gav en like till kommentaren!'),
        'comments_already_liked' => wobt_parse_text('Du har redan lagt en like på denna kommentar.'),
        'comments_no_registering' => wobt_parse_text('Ingen registrering behövs.'),
        'comments_name' => wobt_parse_text('Namn'),
        'comments_email' => wobt_parse_text('E-post'),
        'comments_social' => wobt_parse_text('Blogg/Instagram'),
        'comments_remember_me' => wobt_parse_text('Kom ihåg mig.'),
        'comments_awaiting_moderation' => wobt_parse_text('Din kommentar väntar på godkännande.'),
        'search_whoops' => wobt_parse_text('Ojdå detta var pinsamt,'),
        'search_not_found' => wobt_parse_text('Kunde inte hitta någon sida eller något innehåll som matchar. Försök med en sökning!'),
        // admin
        'admin_page_bg_color' => wobt_parse_text('Sidans bakgrundsfärg:'),
        'admin_page_settings_label' => wobt_parse_text('WOBT Page-inställningar'),
        'menu_label_main' => wobt_parse_text('Wobt Main Menu'),
        'menu_label_footer' => wobt_parse_text('Wobt Footer Menu'),
    ];

    return $t[$key];
}

