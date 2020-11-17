<?php
if ( ! function_exists ( 'ntt__kid_ntt__tag__content_none' ) ) {
    function ntt__kid_ntt__tag__content_none( $subject ='' ) {

        if ( $subject !== '' ) {
            $phrase = '<span class="ntt--empty-content-subject--txt">'. __( ' '. 'for'. ' '.  $subject, 'ntt' ). '</span>';
        } else {
            $phrase = '';
        }

        $mu = '<div class="ntt--empty-content-note ntt--note ntt--cp" data-name="Empty Content Note">';
            $mu .= '<p>'. '<span class="ntt--empty-content-predicate--txt">'. esc_html__( 'Content not found', 'ntt' ). '</span>'. $phrase. '.'. '</p>';
        $mu .= '</div>';
        
        echo $mu;
    }
}