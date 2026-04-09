<div class="text-wrapper-2 group_rules">
    <div class="main-heading">
        <div class="top-heading">
            Group Rules
        </div>
    </div>
    <p>Welcome to <b><i>"<?php echo $groupname; ?>"</i></b>! Before participating, please read the following terms and conditions carefully. By joining the group, you agree to adhere to these guidelines.</p>
    <ol>
        <li>Acceptance of Terms<br>By joining and participating in this group, you accept these terms and conditions. Failure to comply may result in removal from the group without notice.</li>
        <li>Respectful Behavior<br>All members must treat others with respect and courtesy. Offensive, discriminatory, or harassing comments or behavior will not be tolerated. This includes (but is not limited to):<br>Personal attacks or insults<br>Discriminatory language regarding race, gender, religion, or sexual orientation<br>Harassment or bullying of any kind</li>
        <li>No Spamming or Self-Promotion<br>Members are encouraged to contribute to discussions, but unsolicited advertising or spamming is prohibited unless explicitly allowed by the group admin. This includes:<br>Excessive posting of self-promotional links<br>Irrelevant content that disrupts discussions<br>Unauthorized affiliate links or sales pitches</li>
        <li>Confidentiality and Privacy<br>Respect the privacy of fellow members. Sharing private messages, personal details, or sensitive information without consent is prohibited. Remember:<br>What happens in the group stays in the group unless otherwise specified.<br>Do not collect personal data from other members without explicit permission.</li>
        <li>Content Sharing<br>You may share relevant content, but ensure that all content is appropriate and complies with group policies. Any content deemed inappropriate will be removed by the admin. Prohibited content includes:<br>Explicit or violent images and videos<br>Illegal content or discussions promoting unlawful activities<br>False information or misleading content</li>
        <li>Group Admin Authority<br>The group admin reserves the right to:<br>Remove or ban members who violate these terms<br>Delete posts that do not align with group guidelines<br>Modify or update these terms at any time with notice to members</li>
        <li>Legal Responsibility<br>Members are responsible for the content they post. By posting in this group, you agree not to:<br>Violate any laws or regulations<br>Post anything that infringes on copyright, trademarks, or other intellectual property rights<br>Post defamatory or harmful content about others</li>
        <li>Disputes and Resolution<br>In case of a dispute between members, it is encouraged to first attempt to resolve it amicably. The group admin may intervene if necessary but is not responsible for resolving disputes.</li>
        <li>Termination of Membership<br>Membership in this group is voluntary. The group admin may terminate your membership at any time if you fail to comply with these terms, and you may choose to leave the group at any time without notice.</li>
        <li>Changes to the Term.<br>We reserve the right to modify these terms at any time. Any significant changes will be communicated within the group. Continued <br>participation after any modification implies your acceptance of the revised terms.<br>By joining the <b><i>"<?php echo $groupname; ?>"</i></b>, you agree to follow these terms and conditions. Thank you for being part of our community!</li>

        <?php if(!empty($abt['spGroupRules'])) { ?>
            <li><b><?= $abt['spgroupruletitle'] ?? "Addtional Rules" ?></b><br>
                <?php 
                    echo str_replace("[spgrp]",'<b>"'.$groupname.'"<b>', $abt['spGroupRules']);
                ?>
            </li>
        <?php } ?>
    </ol>
</div>

            