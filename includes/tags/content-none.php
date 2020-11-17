<?php
if ( ! function_exists ( 'ntt__kid_ntt__tag__content_none' ) ) {
    function ntt__kid_ntt__tag__content_none() {
        $mu = '<div class="ntt--empty-content-note ntt--note ntt--cp" data-name="Empty Content Note">';
            $mu .= '<p>'. esc_html__( 'Content not found.', 'ntt' ). '</p>';
        $mu .= '</div>';
        
        echo $mu;
    }
}